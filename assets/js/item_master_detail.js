var t
$(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    $(".btn-modal").click(function() {
        $('#modal-default').modal('show')
    });
    $('.datepicker').datepicker({
        autoclose: true
    })
    t = $("#mytable").dataTable({
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
            "url": "../item_master/history/json",
            "type": "POST",
            "data": function(d) {
                d.id = $('#inventory_number').val()
            }
        },
        columns: [{
                "data": "id",
                "orderable": false
            }, {
                "data": "date"
            },
            {
                "data": "user_name"
            },
            {
                "data": "department_name"
            },
            {
                "data": "location_name"
            },
            {
                "data": "porpuse"
            },
            {
                "data": "condition"
            },
            {
                "data": "remark"
            },
            {
                "data": "action",
                "orderable": false,
                "className": "text-center"
            }
        ],
        order: [
            [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

})