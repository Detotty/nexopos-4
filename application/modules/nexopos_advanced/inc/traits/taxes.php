<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait taxes
{
    /**
     *  tax Get
     *  @param int tax id
     *  @return json
    **/

    public function taxes_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_taxes.id as id,
                nexopos_taxes.name as name,
                nexopos_taxes.type as type,
                nexopos_taxes.value as value,
                nexopos_taxes.description as description,
                nexopos_taxes.date_creation as date_creation,
                nexopos_taxes.date_modification as date_modification,
                nexopos_taxes.author as author,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_taxes' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_taxes.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_taxes' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_taxes' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  tax POST
     *  @return json
    **/

    public function taxes_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_taxes' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_taxes', [
            'name'                  =>  $this->post( 'name' ),
            'value'                 =>  $this->post( 'value' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'type'                  =>  $this->post( 'type' )
        ]);

        $this->__success();
    }

    public function taxes_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_taxes' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }


    /**
     *  taxes Update. Update a current tax entry.
     *  @param  int entry id
     *  @return json
    **/

    public function taxes_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_taxes' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_taxes', [
            'name'                  =>  $this->put( 'name' ),
            'value'                  =>  $this->put( 'value' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
            'type'                  =>  $this->put( 'type' )
        ]);

        $this->__success();
    }
}
