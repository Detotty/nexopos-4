tendooApp.factory( 'storesFields', [ 'options', function( options ){
    return [{
        type    :   'hidden',
        label   :   '<?php echo _s( 'Store name', "nexopos_advanced" );?>',
        model   :   'name',
        desc    :   '',
        validation  :   {
            required        :   true
        }
    },{
        type    :   'dropdown_multiselect',
        label   :   '<?php echo __( 'Utilisateurs authorisés', 'nexopos_advanced' );?>',
        model   :   'authorized_users',
        options :   [{id : 1, label: 'test'}]
    },{
        type    :   'select',
        label   :   '<?php echo __( 'Statut', 'nexopos_advanced' );?>',
        model   :   'status',
        options :   options.status,
        validation  :  {
            required   :  true
        }
    },{
        type    :   'text',
        label   :   '<?php echo _s( 'Image', "nexopos_advanced" );?>',
        model   :   'image',
        desc    :   'image'
    },{
        type    :   'textarea',
        label   :   '<?php echo _s( 'Description', "nexopos_advanced" );?>',
        model   :   'description',
        desc    :   '<?php echo _s( 'Fournir plus de détails sur la catégorie.', 'nexopos_advanced' );?>'
    }]
}]);
