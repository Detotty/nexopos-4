tendooApp.factory( 'storeTable', function(){
    return {
        columns     :   [
            {
                text    :   '<?php echo _s( 'Nom', 'nexopos_advanced' );?>',
                namespace   :   'name'
            },{
                text    :   '<?php echo _s( 'Statut', 'nexopos_advanced' );?>',
                namespace   :   'status'
            },{
                text    :   '<?php echo _s( 'Image', 'nexopos_advanced' );?>',
                namespace   :   'image'
            },{
                text    :   '<?php echo _s( 'Utilisateurs authorisés', 'nexopos_advanced' );?>',
                namespace   :   'authorized_users'
            },{
                text    :   '<?php echo _s( 'Par', 'nexopos_advanced' );?>',
                namespace   :   'author_name'
            },{
                text    :   '<?php echo _s( 'Crée le', 'nexopos_advanced' );?>',
                namespace   :   'date_creation'
            },{
                text    :   '<?php echo _s( 'Modifié le', 'nexopos_advanced' );?>',
                namespace   :   'date_modification'
            }
        ]
    }
});
