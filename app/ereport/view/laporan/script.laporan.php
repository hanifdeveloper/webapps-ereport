const laporan = new frameduz("#laporan");
const showMessage = function(status, message) {
    $.bootstrapGrowl("<h4><strong>"+message.title+"</strong></h4> <p>"+message.text+"</p>", {
        type: status,
        delay: 3000,
        allow_dismiss: true,
        offset: {from: "top", amount: 20}
    });
}

laporan.showTable = function(){
    const kategori = $(".form-table").find("#kategori").val();
    laporan.loadTable({
        url: "/ereport/laporan/"+kategori,
        data: $(".form-table").serialize(),
        onShow: function(content){
            content.find("[data-toggle='tooltip']").tooltip();

            content.find(".hal_menonjol").each(function(index, element){
                if ($(element).find("p").html() == "") {
                    element.remove();
                }
            });

            content.find(".btn-detail").each(function(index, element){
                if (this.id == "") {
                    element.remove();
                }
            });

            content.find(".btn-delete").each(function(index, element){
                $(element).hide();
                $(element).on("click", function(e){
                    e.preventDefault();
                    const params = {id: this.id, message: this.getAttribute("data-message")};
                    if(confirm(params.message)){
                        const progress = laporan.createProgress(laporan.table.content);
                        setTimeout(function(){
                            app.sendData({
                                url: "/ereport/laporan/delete",
                                data: params,
                                token: "<?= $this->token; ?>",
                                onSuccess: function(response){
                                    // console.log(response);
                                    progress.remove();
                                    laporan.showTable();
                                    showMessage("info", response.message);
                                },
                                onError: function(error){
                                    // console.log(error);
                                    progress.remove();
                                    showMessage("danger", error.message);
                                }
                            });
                        }, 1000);
                    }
                });
            });
        },
        onPage: function(page_number){
            //console.log(page_number);
            $(".form-table").find("#page").val(page_number);
            laporan.showTable();
        }
    });
    console.clear();
    return false;
}

// laporan.showTable(); // Ke trigger oleh create datepicker
laporan.modul.find(".filter-table").on("change", function(e){
    e.preventDefault();
    $(".form-table").find("#page").val(1);
    laporan.showTable();
});