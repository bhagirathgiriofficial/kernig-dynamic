var Transaction = (function () {
    // Array holding selected row IDs
    var rows_selected = [];
    var data_table;
    return {
        /**
         * Initialization.
         */
        init: function () {
            Transaction.getTransactions();
            Transaction.validateSeachForm();
            Transaction.initializeComponents();
            Transaction.customValidationMethods();
        },

         /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $("#search-form");
            // Date range picker
            Components.datePicker($form);
            //------------------
        }, 
        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            jQuery.validator.addMethod(
                "alphaOnly",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^[a-zA-Z][a-zA-Z ]+$/i.test(value)
                        );
                },
                "Please enter only alphabets only."
                );
            jQuery.validator.addMethod(
                "numericOnly",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^[\+[0-9]{0}[0-9]{1,5}]*$/i.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid whole number."
                );
        },

        /**
         * Validate video Product form.
         */
         validateSeachForm: function () {
            $form = $("#search-form");
            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    user_name: {
                        alphaOnly: true,
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    
                },
                //---------------------------

                highlight: function (element, errorClass, validClass) {
                    $(element)
                    .closest(".form-group")
                    .addClass("has-danger")
                    .removeClass("has-success");
                    $(element)
                    .addClass("is-invalid")
                    .removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element)
                    .closest(".form-group")
                    .addClass("has-success")
                    .removeClass("has-danger");
                    $(element)
                    .addClass("is-valid")
                    .removeClass("is-invalid");
                },
            });
        },
        /**
         * Get transactions list.
         */
        getTransactions: function () {
            var $dataTable = $(".dataTable");

            data_table = table = $dataTable.DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                ajax: {
                    url: $dataTable.data("url"),
                    data: function(d) {
                        d.user_name               = $("input[name=user_name]").val();
                        d.start_date              = $("input[name=start_date]").val();
                        d.end_date                = $("input[name=end_date]").val();
                        d.transaction_status      = $("select[name=status]").val();
                    }
                },
                // columnDefs: [
                //     {
                //         orderable: false,
                //         searchable: false,
                //         targets: 0,
                //         className: "dt-body-center",
                //         render: function (data, type, full, meta) {
                //             return (
                //                 '<div class="checkbox-custom checkbox-primary">' +
                //                 '<input type="checkbox" id="record">' +
                //                 '<label for="record"></label>' +
                //                 "</div>"
                //             );
                //         }
                //     }
                // ],
                aaSorting: [[0, "desc"]],
                // rowCallback: function (row, data, dataIndex) {
                //     // Get row ID
                //     var rowId = data[0];

                //     // If row ID is in the list of selected row IDs
                //     if ($.inArray(rowId, rows_selected) !== -1) {
                //         $(row)
                //             .find('input[type="checkbox"]')
                //             .prop("checked", true);
                //         $(row).addClass("selected");
                //     }
                // },
                columns: [
                    { data: "DT_RowIndex", name: "DT_RowIndex"},
                    { data: "user_details", name: "user_details" },
                    { data: "paypal_payment_id", name: "paypal_payment_id",  orderable: false, searchable: false },
                    { data: "order_number", name: "order_number" },
                    { data: "paid_at", name: "paid_at" },
                    { data: "transaction_amount", name: "transaction_amount" },
                    { data: "transaction_status", name: "transaction_status", orderable: false, searchable: false },
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
            // $dataTable
            //     .find("tbody")
            //     .on("click", 'input[type="checkbox"]', function (e) {
            //         var $row = $(this).closest("tr");

            //         // Get row data
            //         var data = table.row($row).data();

            //         // Get row ID
            //         var rowId = data;

            //         // Determine whether row ID is in the list of selected row IDs
            //         var index = $.inArray(rowId, rows_selected);

            //         // If checkbox is checked and row ID is not in list of selected row IDs
            //         if (this.checked && index === -1) {
            //             rows_selected.push(rowId);

            //             // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            //         } else if (!this.checked && index !== -1) {
            //             rows_selected.splice(index, 1);
            //         }

            //         // if (
            //         //     $dataTable.find('tbody input[type="checkbox"]:checked')
            //         //         .length > 0
            //         // ) {
            //         //     $(".change-status").prop("disabled", false);
            //         //     $(".dt-delete").prop("disabled", false);
            //         // } else {
            //         //     $(".change-status").prop("disabled", true);
            //         //     $(".dt-delete").prop("disabled", true);
            //         // }

            //         if (this.checked) {
            //             $row.addClass("selected");
            //         } else {
            //             $row.removeClass("selected");
            //         }

            //         // Update state of "Select all" control
            //         // Transaction.updateDataTableSelectAllCtrl(table);

            //         // Prevent click event from propagating to parent
            //         e.stopPropagation();
            //     });

        }
    };
})();

Transaction.init();
