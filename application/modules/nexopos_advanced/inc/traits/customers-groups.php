<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Trait customers_groups
{
    /**
     *  customersGroups Get
     *  @param int delivvery id
     *  @return json
    **/

    public function customers_groups_get( $id = null )
    {
        if( $id == null ) {

            $this->db->select( '
                nexopos_customers_groups.id as id,
                nexopos_customers_groups.name as name,
                nexopos_customers_groups.description as description,
                nexopos_customers_groups.enable_discount as enable_discount,
                nexopos_customers_groups.discount_start as discount_start,
                nexopos_customers_groups.discount_end as discount_end,
                nexopos_customers_groups.discount_type as discount_type,
                nexopos_customers_groups.discount_value as discount_value,
                nexopos_customers_groups.date_creation as date_creation,
                nexopos_customers_groups.date_modification as date_modification,
                aauth_users.name        as author_name
            ' );

            $this->db->from( 'nexopos_customers_groups' );
            // Order Request
            if( $this->get( 'order_by' ) ) {
                $this->db->order_by( $this->get( 'order_by' ), $this->get( 'order_type' ) );
            }

            if( $this->get( 'limit' ) ) {
                $this->db->limit( $this->get( 'limit' ), $this->get( 'current_page' ) );
            }

            $this->db->join( 'aauth_users', 'aauth_users.id = nexopos_customers_groups.author' );
            $query      =   $this->db->get();

            return $this->response([
                'entries'   =>  $query->result(),
                'num_rows'  =>  $this->db->get( 'nexopos_customers_groups' )->num_rows()
            ], 200 );
        }

        $result     =   $this->db->where( 'id', $id )->get( 'nexopos_customers_groups' )->result();

        return $result ? $this->response( ( array ) @$result[0], 200 ) : $this->__404();
    }

    /**
     *  Customer Groups POST
     *  @return json
    **/

    public function customers_groups_post()
    {
        if( $this->db->where( 'name', $this->post( 'name' ) )->get( 'nexopos_customers_groups' )->num_rows() ) {
            $this->__alreadyExists();
        }

        $this->db->insert( 'nexopos_customers_groups', [
            'name'                  =>  $this->post( 'name' ),
            'description'           =>  $this->post( 'description' ),
            'author'                =>  $this->post( 'author' ),
            'date_creation'         =>  $this->post( 'date_creation' ),
            'enable_discount'         =>  $this->post( 'enable_discount' ),
            'discount_start'             =>  $this->post( 'discount_start' ),
            'discount_end'         =>  $this->post( 'discount_end' ),
            'discount_type'         =>  $this->post( 'discount_type' ),
            'discount_value'         =>  $this->post( 'discount_value' )
        ]);

        $this->__success();
    }

    /**
     *  delete
     *  @param void
     *  @return json
    **/

    public function customers_groups_delete()
    {
        if( is_array( $_GET[ 'ids' ] ) ) {
            foreach( $_GET[ 'ids' ] as $id ) {
                $this->db->where( 'id', ( int ) $id )->delete( 'nexopos_customers_groups' );
            }
            return $this->__success();
        }
        return $this->__failed();
    }

    /**
     *  customers_groups Update. Update a cuurent entry.
     *  @param  int entry id
     *  @return json
    **/

    public function customers_groups_put( $id )
    {
        $alreadyExists      =   $this->db->where( 'name', $this->put( 'name' ) )
        ->where( 'id !=', $id )
        ->get( 'nexopos_customers_groups' )
        ->num_rows();

        if( $alreadyExists ) {
            $this->__alreadyExists();
        }

        $this->db->where( 'id', $id )->update( 'nexopos_customers_groups', [
            'name'                  =>  $this->put( 'name' ),
            'description'           =>  $this->put( 'description' ),
            'author'                =>  $this->put( 'author' ),
            'date_modification'     =>  $this->put( 'date_modification' ),
            'enable_discount'         =>  $this->put( 'enable_discount' ),
            'discount_start'             =>  $this->put( 'discount_start' ),
            'discount_end'         =>  $this->put( 'discount_end' ),
            'discount_type'         =>  $this->put( 'discount_type' ),
            'discount_value'         =>  $this->put( 'discount_value' )
        ]);

        $this->__success();
    }
}
