tendooApp.factory( 'sharedFilterItem', function(){
    return function( item, regularFields, advancedFields ) {

        var item    =   angular.copy( item );

        var regularFieldsNamespaces  =   [ 'variations' ];
        _.each( regularFields, function( field ) {
            regularFieldsNamespaces.push( field.model );
        });

        // Delete unused data on top
        _.each( item, function( value, key ) {
            if( _.indexOf( regularFieldsNamespaces, key ) == -1 ) {
                delete item[ key ];
            }
        });

        _.each( item.variations, function( variation, variation_index ){
            _.each( variation.tabs, function( tab ) {
                item.variations[ variation_index ]       =   _.extend( variation, tab.models );
            });
        });

        _.each( item.variations, function( variation, variation_index ){
            delete variation.tabs;
            _.each( variation, function( field, group_namespace ){
                if( angular.isArray( field ) ) {
                    _.each( field, function( group ) {
                        group       =   _.extend( group, group.models );
                        delete group.errors;
                        delete group.models;
                    });
                }
            })
        })

        return item;
    }
})
