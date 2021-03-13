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
    console.clear();
    return false;
}

satker.showForm = function(id){
    const form_content = satker.form.clone();
    form_content.attr("id", "form-input");
    form_content.on("submit", function(event){
        const progress = satker.createProgress(dialog.content);
        setTimeout(function(){
            console.log($(this).serialize());
            progress.remove();
        }, 1000);
    });
    
    setTimeout(function(){
        app.sendData({
            url: "/ereport/satker/form",
            data: {id},
            token: "<?= $this->token; ?>",
            onSuccess: function(response){
                console.log(response);
                const data = response.data;
                const form = data.form;

                dialog.title.html(data.form_title);
                dialog.body.html(form_content);
                dialog.submit.attr("form", "form-input");
                dialog.modal("show");
                
            },
            onError: function(error){
                console.log(error);
            }
        });
    }, 500);
}

satker.showTable();
satker.modul.find("#cari").on("input", function(e){
    e.preventDefault();
    $(".form-table").find("#page").val(1);
});
satker.modul.find(".btn-form").on("click", function(e){
    e.preventDefault();
    satker.showForm(this.id);
    // console.log(satker.form);
});