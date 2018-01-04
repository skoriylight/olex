if (typeof ltcart == "undefined" || !ltcart) {
    var ltcart = {};
}

ltcart.tree = {

    checkboxContainer: '#hidden_check',
    treeContainer: '#category-tree',

    init: function () {


        $(ltcart.tree.treeContainer).bind("check_node.jstree , uncheck_node.jstree , loaded.jstree", function (e, data) {

            ltcart.tree.renderCheckboxContainer();
        });

        $(ltcart.tree.treeContainer).bind('check_node.jstree', function (e, data) {

            ltcart.tree.renderCheckboxContainer(data);
            ltcart.tree.addSelectOptions(data.node.id, data.node.text);
        });

        $(ltcart.tree.treeContainer).bind('uncheck_node.jstree', function (e, data) {

            ltcart.tree.deleteSelectOptions(data.node.id);
        });
    },

    renderCheckboxContainer: function (data) {

        var ids = $(ltcart.tree.treeContainer).jstree(true).get_checked();

        var str = '';
        for (var key in ids) {
            str += '<input type="hidden" name="Product[category_ids][]" value="' + ids[key] + '" />';
        }


        if(data) {
            ltcart.tree.setParentNode(data);
        }
        $(ltcart.tree.checkboxContainer).html(str);
        //ltcart.tree.renderSelectOptions();
    },

    deleteSelectOptions: function(id){
        $('#product_category_id option[value='+id+']').remove()

    },

    addSelectOptions: function(id, name){

        $('#product_category_id').append('<option value="'+id+'">'+name+'</option>');

    }
    ,
    setParentNode: function (data) {
        var node = data.node;


        node.parents.forEach(function (id) {
            nod = data.instance.get_node(id.trim());
            if(id.trim() !== '#') {
                data.instance.check_node(nod);
            }
            //alert(nod.id);
        });


    }
}

$(function(){
    ltcart.tree.init();

})

