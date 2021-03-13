const satker = new frameduz("#satker");
const dialog = satker.createDialog("#modal-fade");
satker.showTable = function(){
    satker.loadTable({
        url: "/ereport/satker/list",
        data: $(".form-table").serialize(),
        onShow: function(){
            //
        },
        onPage: function(page_number){
            $(".form-table").find("#page").val(page_number);
            $(".form-table").submit();
        }
    });

    return false;
}

satker.showTable();
satker.modul.find("#cari").on("input", function(e){
    e.preventDefault();
    $(".form-table").find("#page").val(1);
});
satker.modul.find(".btn-form").on("click", function(e){
    e.preventDefault();
    dialog.title.html("Input Satker");
    dialog.body.html("Hello World");
    dialog.action.off();
    dialog.action.on("click", function(e){
        console.log("hello");
    });
    dialog.modal("show");
});