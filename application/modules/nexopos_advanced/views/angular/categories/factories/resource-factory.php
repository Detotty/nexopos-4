<?php
global $Options;
$this->load->config( 'rest' );
?>
tendooApp.factory( 'categoriesResource', function( $resource ) {
    return $resource(
        '<?php echo site_url( [ 'rest', 'nexopos_advanced', 'categories/:id?order_by=:order_by&order_type=:order_type&limit=:limit&search=:search' ]);?>',
        {
            id              :   '@_id',
            order_by        :   '@_order_by',
            order_type      :   '@_order_type',
            limit           :   '@_limit',
            current_page    :   '@_current_page',
            exclude         :   '@_exclude',
            search          :   '@_search'
        },{
            get  : {
                method : 'GET',
                headers			:	{
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            },
            save    :   {
                method : 'POST',
                headers : {
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            },
            update :    {
                method : 'PUT',
                headers : {
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            },
            delete : {
                method : 'DELETE',
                headers : {
                    '<?php echo $this->config->item('rest_key_name');?>'	:	'<?php echo @$Options[ 'rest_key' ];?>'
                }
            }
        }
    );
});
