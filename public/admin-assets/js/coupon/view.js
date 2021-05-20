var Coupon = (function () {
    // Array holding selected row IDs
    var rows_selected = [];
    var data_table;
    return {
        /**
         * Initialization.
         */
        init: function () {
            Coupon.getCoupon();
            Coupon.changeStatus();
            Coupon.destroyRecord();
            Coupon.initializeComponents();
        },

        /**
         * Initialize components.
         */
        initializeComponents: function () {
            var $form = $("#search-form");            
        },

        /**
         * Updates "Select all" control in a data table
         */
        updateDataTableSelectAllCtrl: function (table) { 
            var $table = table.table().node();
            var $chkbox_all = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked = $(
                'tbody input[type="checkbox"]:checked',
                $table
            );
            var chkbox_select_all = $(
                'thead input[name="select_all"]',
                $table
            ).get(0);

            // If none of the checkboxes are checked
            if ($chkbox_checked.length === 0) {
                chkbox_select_all.checked = false;
                if ("indeterminate" in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If all of the checkboxes are checked
            } else if ($chkbox_checked.length === $chkbox_all.length) {
                chkbox_select_all.checked = true;
                if ("indeterminate" in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If some of the checkboxes are checked
            } else {
                chkbox_select_all.checked = true;
                if ("indeterminate" in chkbox_select_all) {
                    chkbox_select_all.indeterminate = true;
                }
            }
        },

        /**
         * Get Coupon list.
         */
        getCoupon: function () {
            var $dataTable = $(".dataTable");

            data_table = table = $dataTable.DataTable({
                initComplete: function () {
                    // if (data_table.row().count() == 0) {
                    //     data_table
                    //         .buttons(".buttons-csv")
                    //         .nodes()
                    //         .css("display", "none");
                    //     data_table
                    //         .buttons(".buttons-pdf")
                    //         .nodes()
                    //         .css("display", "none");
                    // } else {
                    //     data_table
                    //         .buttons(".buttons-csv")
                    //         .nodes()
                    //         .css("display", "block");
                    //     data_table
                    //         .buttons(".buttons-pdf")
                    //         .nodes()
                    //         .css("display", "block");
                    // }
                    $(".dt-buttons").addClass("btn-toolbar btn-group");
                    $(".buttons-csv").addClass(
                        "btn btn-icon btn-default btn-outline"
                    );
                    $(".buttons-pdf").addClass(
                        "btn btn-icon btn-default btn-outline"
                    );

                    // $(".buttons-csv").html(
                    //     '<div> Download CSV <i title="Download CSV" class="fa fa-file-text"/></div>'
                    // );
                    // $(".buttons-pdf").html(
                    //     '<div> Download PDF <i title="Download PDF" class="fa fa-file"/></div>'
                    // );

                    $(
                        '<div class="btn-toolbar"> ' +
                        '<div class="btn-group" role="group"> ' +
                        '<button type="button" title="Change Status" class="btn btn-icon btn-default btn-outline change-status" disabled><i class="icon fa fa-exchange" aria-hidden="true"></i></button> ' +
                        '<button type="button" title="Delete" class="btn btn-icon btn-default btn-outline dt-delete text-danger" disabled><i class="icon wb-trash" aria-hidden="true"></i></button> ' +
                        "</div> " +
                        "</div>"
                    ).insertAfter(".dataTables_filter");
                },
                processing: true,
                serverSide: true,
                lengthChange: true,
                "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                buttons: [
                    // {
                    //     extend: "csv",
                    //     title: "Coupon",
                    //     exportOptions: {
                    //         columns: [2, 3, 4]
                    //     }
                    // },
                    // {
                    //     extend: "pdf",
                    //     title: "Coupon",
                    //     orientation: "portrait", //portrait
                    //     pageSize: "A4", //A3 , A5 , A6 , legal , letter
                    //     exportOptions: {
                    //         columns: [2, 3, 4],
                    //         search: "applied",
                    //         order: "applied"
                    //     },
                    //     //--------------------------
                    //     customize: function (doc) {
                    //         doc.defaultStyle.alignment = "left";
                    //         doc.styles.tableHeader.alignment = "left";
                    //         doc.content[1].table.widths = Array(
                    //             doc.content[1].table.body[0].length + 1
                    //         )
                    //             .join("*")
                    //             .split("");
                    //     }
                    // }
                ],
                ajax: {
                    url: $dataTable.data("url"),
                    data: function (d) {
                        d.coupon_code = $("input[name=coupon_code]").val();
                    }
                },
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: 0,
                        className: "dt-body-center",
                        render: function (data, type, full, meta) {
                            return (
                                '<div class="checkbox-custom checkbox-primary">' +
                                '<input type="checkbox" id="record">' +
                                '<label for="record"></label>' +
                                "</div>"
                            );
                        }
                    }
                ],
                aaSorting: [[1, "asc"]],
                rowCallback: function (row, data, dataIndex) {
                    // Get row ID
                    var rowId = data[0];

                    // If row ID is in the list of selected row IDs
                    if ($.inArray(rowId, rows_selected) !== -1) {
                        $(row)
                            .find('input[type="checkbox"]')
                            .prop("checked", true);
                        $(row).addClass("selected");
                    }
                },
                columns: [
                    { data: null, name: null },
                    { data: "DT_RowIndex", name: "DT_RowIndex" },
                    { data: "coupon_code", name: "coupon_code" },
                    { data: "discount", name: "discount" },
                    { data: "price_range", name: "price_range"},
                    { data: "valid", name: "valid"},
                    { data: "created_at", name:"created_at"},
                    { data: "status", name: "status" },
                    { data: "action", name: "action" },
                ]
            });

            // Search button
            $("#search-form").on("submit", function (e) {
                table.draw();
                e.preventDefault();
            });

            // Clear button
            $("#clearBtn").click(function () {
                location.reload();
            });

            // Handle click on checkbox
            $dataTable
                .find("tbody")
                .on("click", 'input[type="checkbox"]', function (e) {
                    var $row = $(this).closest("tr");

                    // Get row data
                    var data = table.row($row).data();

                    // Get row ID
                    var rowId = data;

                    // Determine whether row ID is in the list of selected row IDs
                    var index = $.inArray(rowId, rows_selected);

                    // If checkbox is checked and row ID is not in list of selected row IDs
                    if (this.checked && index === -1) {
                        rows_selected.push(rowId);

                        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                    } else if (!this.checked && index !== -1) {
                        rows_selected.splice(index, 1);
                    }

                    if (
                        $dataTable.find('tbody input[type="checkbox"]:checked')
                            .length > 0
                    ) {
                        $(".change-status").prop("disabled", false);
                        $(".dt-delete").prop("disabled", false);
                    } else {
                        $(".change-status").prop("disabled", true);
                        $(".dt-delete").prop("disabled", true);
                    }

                    if (this.checked) {
                        $row.addClass("selected");
                    } else {
                        $row.removeClass("selected");
                    }

                    // Update state of "Select all" control
                    Coupon.updateDataTableSelectAllCtrl(table);

                    // Prevent click event from propagating to parent
                    e.stopPropagation();
                });

            // Handle click on "Select all" control
            $('thead input[name="select_all"]', table.table().container()).on(
                "click",
                function (e) {
                    if (this.checked) {
                        $dataTable
                            .find('tbody input[type="checkbox"]:not(:checked)')
                            .trigger("click");
                        $(".change-status").prop("disabled", false);
                        $(".dt-delete").prop("disabled", false);
                    } else {
                        $dataTable
                            .find('tbody input[type="checkbox"]:checked')
                            .trigger("click");
                        $(".change-status").prop("disabled", true);
                        $(".dt-delete").prop("disabled", true);
                    }

                    // Prevent click event from propagating to parent
                    e.stopPropagation();
                }
            );

            // Handle table draw event
            table.on("draw", function () {
                // Update state of "Select all" control
                Coupon.updateDataTableSelectAllCtrl(table);
            });
        },

        /**
         * Change status.
         */
        changeStatus: function () {
            var $data_table_container = $(".data-table-container");
            var $dataTable = $(".dataTable");

            // Handle form submission event
            $data_table_container.on("click", ".change-status", function () {
                // Iterate over all selected checkboxes
                var ids = [];
                $.each(rows_selected, function (index, rowId) {
                    ids.push(rowId.coupon_id);
                });

                $.ajax({
                    type: "POST",
                    url: $dataTable.data("change-status-url"),
                    data: { ids: ids },
                    beforeSend: function () {
                        $(".change-status").prop("disabled", true);
                    },
                    success: function (response) {
                        App.showNotification(response);
                        data_table.draw();
                        rows_selected = [];

                    },
                    error: function () { },
                    complete: function () {
                        $(".change-status").prop("disabled", true);
                    }
                });
            });
        },

        /**
         * Destroy record.
         */
        destroyRecord: function () {
            var $data_table_container = $(".data-table-container");
            var $dataTable = $(".dataTable");

            // Handle form submission event
            $data_table_container.on("click", ".dt-delete", function () {
                // Iterate over all selected checkboxes
                var ids = [];
                $.each(rows_selected, function (index, rowId) {
                    ids.push(rowId.coupon_id);
                });

                console.log(ids);

                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: "once",
                    color: "yellow",
                    id: "question",
                    zindex: 99999,
                    title: "Hey!",
                    message: "Are you sure you want to delete the selected record?",
                    position: "center",
                    progressBar: false,
                    buttons: [
                        [
                            "<button><b>YES</b></button>",
                            function (instance, toast) {
                                console.log($dataTable.data("destroy-url"));
                                $.ajax({
                                    type: "DELETE",
                                    url: $dataTable.data("destroy-url"),
                                    data: { ids: ids },
                                    beforeSend: function () {
                                        $(".dt-delete").prop("disabled", true);
                                    },
                                    success: function (response) {
                                        App.showNotification(response);
                                        data_table.draw();
                                        $ids = [];
                                        rows_selected = [];

                                    },
                                    error: function () { },
                                    complete: function () {
                                        $(".dt-delete").prop("disabled", true);
                                    }
                                });
                                instance.hide(
                                    { transitionOut: "fadeOut" },
                                    toast,
                                    "button"
                                );
                            },
                            true
                        ],
                        [
                            "<button>NO</button>",
                            function (instance, toast) {
                                instance.hide(
                                    { transitionOut: "fadeOut" },
                                    toast,
                                    "button"
                                );
                            }
                        ]
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        console.info("Closing | closedBy: " + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info("Closed | closedBy: " + closedBy);
                    }
                });
            });
        }
    };
})();

Coupon.init();
