var Components = (function() {
    return {
        /**
         * Initialization.
         */
        init: function() {
            //
        },

        /**
         * Date picker.
         */
        datePicker: function($source) {
            // var $date_picker = $source.find(".date-picker");
            // if ($date_picker.length) {
            //     $date_picker.datepicker({
            //         format: "dd/mm/yyyy"
            //     });
            // }
            var $start_date_picker = $source.find(".start-date-picker");
            var $end_date_picker = $source.find(".end-date-picker");

            if ($start_date_picker.length) {
                $start_date_picker 
                    .datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                        // startDate: new Date()
                    })
                    .on("changeDate", function(selected) {
                        var minDate = new Date(selected.date.valueOf());
                        $end_date_picker.datepicker("setStartDate", minDate);
                    });
            }

            if ($end_date_picker.length) {
                $end_date_picker
                    .datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                        // startDate: new Date()
                    })
                    .on("changeDate", function(selected) {
                        var maxDate = new Date(selected.date.valueOf());
                        $start_date_picker.datepicker("setEndDate", maxDate);
                    });
            }
            
        },

        /**
         * Date Range picker. 
         */
        dateRangePicker: function($source) {
            var $start_date_picker = $source.find(".start-date-picker");
            var $end_date_picker = $source.find(".end-date-picker");

            if ($start_date_picker.length) {
                $start_date_picker
                    .datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                        startDate: new Date()
                    })
                    .on("changeDate", function(selected) {
                        var minDate = new Date(selected.date.valueOf());
                        $end_date_picker.datepicker("setStartDate", minDate);
                    });
            }

            if ($end_date_picker.length) {
                $end_date_picker
                    .datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                        startDate: new Date()
                    })
                    .on("changeDate", function(selected) {
                        var maxDate = new Date(selected.date.valueOf());
                        $start_date_picker.datepicker("setEndDate", maxDate);
                    });
            }
        },

        /**
         * Image preview.
         */
        imagePreview: function($source) {
            var $image_preview = $source.find(".image-preview");

            if ($image_preview.length) {
                $image_preview.dropify({
                    allowedFileExtensions: "jpg jpeg png gif ",
                    showRemove: true
                });
            }
        },

        /**
         * Bootstrap select.
         */
        bootstrapSelect: function($source) {
            var $select = $source.find(".select-picker");

            if ($select.length) {
                $select.selectpicker({
                    liveSearch: true,
                    selectedTextFormat: "count > 3",
                    size: "8"
                });
            }
        },

        /**
         * Add new entity.
         */
        addNewEntity: function($source) {
            $source.on("click", ".add-new-entity", function() {
                var $this = $(this);
                var $add_new_entity_modal = $("#add-new-entity-modal");

                $add_new_entity_modal.modal("show");
                $add_new_entity_modal
                    .find(".modal-content")
                    .load($this.data("url"), function() {
                        Components.validateAddNewEntityForm(
                            $add_new_entity_modal
                        );
                        Components.addNewEntityForm(
                            $add_new_entity_modal,
                            $this
                        );
                        Components.bootstrapSelect($add_new_entity_modal);
                    });

                $add_new_entity_modal.on("hidden.bs.modal", function() {
                    App.resetModal($add_new_entity_modal);
                });
            });
        },

        /**
         * Validate add new entity form.
         */
        validateAddNewEntityForm: function($source) {
            var $form = $source.find("form");

            $form.find("select").change(function() {
                $(this).valid();
            });

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    //
                },
                //------------------

                // @validation error messages
                messages: {
                    //
                },
                //---------------------------

                highlight: function(element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-danger")
                        .removeClass("has-success");
                    $(element)
                        .addClass("is-invalid")
                        .removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-success")
                        .removeClass("has-danger");
                    $(element)
                        .addClass("is-valid")
                        .removeClass("is-invalid");
                },

                submitHandler: function(form) {
                    //
                }
            });
        },

        /**
         * Add new entity form.
         */
        addNewEntityForm: function($source, $this) {
            $source.find("form").on("click", ".btn-submit", function(e) {
                e.preventDefault();

                if ($source.find("form").valid()) {
                    $form = $source.find("form");

                    $.ajax({
                        url: $form.attr("action"),
                        type: "POST",
                        data: $form.serialize(),
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $form.find("#custom-error").html("");
                            App.formLoading($form);
                        },
                        success: function(response) {
                            var data = response._data;
                            var grouped = response.grouped;

                            if (response._status == true) {
                                if (grouped) {
                                    var $form_group = $this.closest(
                                        ".form-group"
                                    );
                                    var selectedText = $form
                                        .find("select option:selected")
                                        .text();
                                    var $optgroups = $form_group.find(
                                        "select optgroup"
                                    );
                                    var $addable_optgroup = null;

                                    $.each($optgroups, function(
                                        index,
                                        optgroup
                                    ) {
                                        var $optgroup = $(optgroup);

                                        if (
                                            $optgroup.attr("label") ==
                                            selectedText
                                        ) {
                                            $addable_optgroup = $optgroup;

                                            return false;
                                        }
                                    });

                                    if ($addable_optgroup) {
                                        var html = "";
                                        html +=
                                            '<option selected value="' +
                                            data.id +
                                            '">' +
                                            data.name +
                                            "</option>";
                                        $addable_optgroup.append(html);
                                        $form_group
                                            .find("select")
                                            .selectpicker("refresh");
                                    }
                                } else {
                                    var html = "";
                                    var $form_group = $this.closest(
                                        ".form-group"
                                    );
                                    html +=
                                        '<option selected value="' +
                                        data.id +
                                        '">' +
                                        data.name +
                                        "</option>";
                                    $form_group.find("select").append(html);
                                    $form_group
                                        .find("select")
                                        .selectpicker("refresh");
                                }
                                $source.modal("hide");
                            }

                            // Show notification
                            App.showNotification(response);
                            //------------------
                        },
                        error: function(response) {
                            if (response.responseJSON._status == false) {
                                $form
                                    .find("#custom-error")
                                    .html(
                                        '<div class="alert dark alert-danger alert-dismissible"> ' +
                                            response.responseJSON._message +
                                            " </div>"
                                    );
                            }
                        },
                        complete: function(response) {
                            App.stopFormLoading($form);
                        }
                    });
                    return false;
                }
            });
        },

        /**
         * Change language input.
         */
        changeLanguageInput: function($source) {
            $source.on("click", ".switch-language", function() {
                var $this = $(this);
                var language = $this.data("input");
                var $form_group = $this.closest(".form-group");

                if (language == "hindi") {
                    if (!$form_group.find(".editor-textarea").length) {
                        $form_group.find(".hindi-input").show();
                        $form_group.find(".hindi-input").focus();
                        $form_group.find(".english-input").hide();
                        $form_group.find("#name-error").hide();
                    }
                } else {
                    if (!$form_group.find(".editor-textarea").length) {
                        $form_group.find(".english-input").show();
                        $form_group.find(".english-input").focus();
                        $form_group.find(".hindi-input").hide();
                        $form_group.find("#name-error").show();
                    }
                }
                $this.addClass("active");
                $form_group
                    .find(".switch-language")
                    .not($this)
                    .removeClass("active");
            });
        },

        /**
         * Description editor.
         */
        descriptionEditor: function($source) {
            $source.find(".editor-textarea").summernote({
                placeholder: "Enter text here...",
                //  toolbar: [
                // // [groupName, [list of button]]
                // ['style', ['bold', 'italic', 'underline', 'clear']],
                // ['fontsize', ['fontsize']],
                // ],
                resizeEditor: true,
                spellCheck: true,
                callbacks: {
                    
                    onKeyup: function() {
                        $(this).valid();
                    }
                }
            });
        },

        /**
         * Change language input tabing.
         */
        changeLanguageInputTabing: function($source) {
            $source.on("click", ".switch-language", function() {
                var $this = $(this);
                var language = $this.data("input");
                var $form_group = $this.closest(".form-group");

                if (language == "hindi") {
                    $form_group.find(".hindi-tab").removeClass("hide-block");
                    $form_group.find(".english-tab").addClass("hide-block");
                } else {
                    $form_group.find(".hindi-tab").addClass("hide-block");
                    $form_group.find(".english-tab").removeClass("hide-block");
                }
            });
        },

        /**
         * Change direction question type.
         */
        changeDirectionQuestionType: function($source) {
            $source.on("click", ".direction-type", function() {
                // alert('test');
                var $this = $(this);
                var type = $this.val();
                var $question_row = $this.closest(".direction-panel");
                // alert($question_row);
                if (type == 1) {
                    // alert($question_row.find(".direction-new").html());
                    $question_row.find(".direction-new").show();
                    $question_row.find(".direction-exist").hide();
                    $("#direction_section").rules("remove", "required");

                    //Add validation rules in direction question in english
                    if ($("#en_direction_ques_type_text:checked").val() == 1) {
                        // Remove validation if direcction question type = 1
                        $("#en_direction_description_image").rules(
                            "remove",
                            "required"
                        );

                        $("#en_direction_description_text").rules("add", {
                            required: true,
                            messages: {
                                required:
                                    "Please enter direction question in english."
                            }
                        });
                        //------------------------------------
                    } else {
                        // Remove validation if question type = 0
                        $("#en_direction_description_text").rules(
                            "remove",
                            "required"
                        );

                        $("#en_direction_description_image").rules("add", {
                            required: true,
                            messages: {
                                required:
                                    "Please select direction question image in english."
                            }
                        });
                    }

                    //Add validation rules in direction question in hindi
                    if ($("#hn_direction_ques_type_text:checked").val() == 1) {
                        // Remove validation if direcction question type = 1
                        $("#hn_direction_description_image").rules(
                            "remove",
                            "required"
                        );

                        $("#hn_direction_description_text").rules("add", {
                            required: true,
                            messages: {
                                required:
                                    "Please enter direction question in hindi."
                            }
                        });
                        //------------------------------------
                    } else {
                        // Remove validation if question type = 0
                        $("#hn_direction_description_text").rules(
                            "remove",
                            "required"
                        );

                        $("#hn_direction_description_image").rules("add", {
                            required: true,
                            messages: {
                                required:
                                    "Please select direction question image in hindi."
                            }
                        });
                    }
                    $("#en_direction_description_title").rules("add", {
                        required: true,
                        messages: {
                            required:
                                "Please enter direction question title in english."
                        }
                    });

                    $("#hn_direction_description_title").rules("add", {
                        required: true,
                        messages: {
                            required:
                                "Please enter direction question title in hindi."
                        }
                    });
                } else {
                    // alert($question_row.find(".direction-exist").html());
                    $question_row.find(".direction-new").hide();
                    $question_row.find(".direction-exist").show();
                    $("#direction_section").rules("add", {
                        required: true,
                        messages: {
                            required: "Please select direction question."
                        }
                    });
                    $("#en_direction_description_text").rules(
                        "remove",
                        "required"
                    );
                    $("#en_direction_description_image").rules(
                        "remove",
                        "required"
                    );

                    $("#hn_direction_description_text").rules(
                        "remove",
                        "required"
                    );
                    $("#hn_direction_description_image").rules(
                        "remove",
                        "required"
                    );

                    $("#en_direction_description_title").rules(
                        "remove",
                        "required"
                    );
                    $("#hn_direction_description_title").rules(
                        "remove",
                        "required"
                    );
                }
            });
        },

        /**
         * Change question type.
         */
        changeQuestionType: function($source) {
            $source.on("click", ".switch-question-type", function() {
                var $this = $(this);
                var type = $this.val();
                var $question_row = $this.closest(".question-row");
                if (type == 1) {
                    $question_row.find(".question-text").show();
                    $question_row.find(".question-image").hide();
                } else {
                    $question_row.find(".question-text").hide();
                    $question_row.find(".question-image").show();
                }
            });
        },

        /**
         * Check same as english.
         */
        checkSameAsEnglish: function($source) {
            $source.on("click", ".check-same-as-english", function() {
                var $this = $(this);
                var $question_row = $this.closest(".question-row");

                if ($(this).prop("checked") == true) {
                    $question_row
                        .find(".question-block")
                        .append(
                            '<div class="question-block-disabled"> <div class="same_as">Same As English</div> </div>'
                        );
                } else if ($(this).prop("checked") == false) {
                    $question_row
                        .find(".question-block .question-block-disabled")
                        .remove();
                }
            });
        },

        /**
         * Remove image.
         */
        removeImage: function($source) {
            var $image = $(".image-main");

            $source.on("click", ".dropify-clear", function() {
                $.ajax({
                    type: "POST",
                    url: $image.data("remove-image-url"),
                    data: {
                        id: $image.data("remove-image-id")
                    },
                    beforeSend: function() {
                        //  
                    },
                    success: function(response) {
                        App.showNotification(response);
                    },
                    error: function() {},
                    complete: function() {
                        //
                    }
                });
            });
        },

        /**
         * Hide Content.
         */
        hideContent: function($source) {
            $source.find(".mock-package").hide();
            $source.find(".subscription").hide();

            $discount_for = $source.find("#discount_for").val();
            if ($discount_for == 1) {
                $source.find(".mock-package").hide();
                $source.find(".subscription").show();
            }
            if ($discount_for == 2) {
                $source.find(".mock-package").show();
                $source.find(".subscription").hide();
            }
        },

        // /**
        //  * Change discount for.
        //  */
        // changeDiscountFor: function($source) {
        //     $source.on("change", ".discount-for", function() {
        //         var $this = $(this);
        //         var type = $source.find("#discount_for").val();
        //         var category = $source.find("#category").val();

        //         if (type == 1) {
        //             $source.find(".hide-block").show();
        //             $source.find(".mock-package").hide();
        //             $source.find(".subscription").show();
        //             $source.find("#mock_package").val("");
        //         }
        //         if (type == 2) {
        //             $source.find(".hide-block").show();
        //             $source.find(".mock-package").show();
        //             $source.find(".subscription").hide();
        //             $source.find("#subscription").val("");
        //         }

        //         if (type != "" && category != "") {
        //             $(".mycustloading").show();
        //             $.ajax({
        //                 type: "GET",
        //                 url: $this.data("discount-url"),
        //                 data: {
        //                     type: type,
        //                     category: category
        //                 },
        //                 success: function(response) {
        //                     if (type == 1) {
        //                         if (response._status == true) {
        //                             var subscriptions = response._data;
        //                             var options =
        //                                 '<option selected="selected" value=""> Select Subscription </option>';

        //                             $.each(subscriptions, function(
        //                                 index,
        //                                 subscription
        //                             ) {
        //                                 options +=
        //                                     '<option value="' +
        //                                     subscription.id +
        //                                     '">' +
        //                                     subscription.subscription_type
        //                                         .type +
        //                                     "</option>";
        //                             });
        //                             $("#subscription").html(options);
        //                             $("#subscription").selectpicker("refresh");
        //                         } else if (response._status == false) {
        //                             var options =
        //                                 '<option value=""> Select Subscription </option>';
        //                             $("#subscription").html(options);
        //                         }
        //                     }
        //                     if (type == 2) {
        //                         if (response._status == true) {
        //                             var packages = response._data;
        //                             var options =
        //                                 '<option selected="selected" value=""> Select Package </option>';

        //                             $.each(packages, function(index, package) {
        //                                 options +=
        //                                     '<option value="' +
        //                                     package.id +
        //                                     '">' +
        //                                     package.name +
        //                                     "</option>";
        //                             });
        //                             $("#package").html(options);
        //                             $("#package").selectpicker("refresh");
        //                         } else if (response._status == false) {
        //                             var options =
        //                                 '<option value=""> Select Package </option>';
        //                             $("#package").html(options);
        //                         }
        //                     }
        //                     $(".mycustloading").hide();
        //                 }
        //             });
        //         } else {
        //             if (type == 1) {
        //                 $("select[name='subscription'").html("");
        //             }
        //             if (type == 2) {
        //                 $("select[name='package'").html("");
        //             }
        //             $(".mycustloading").hide();
        //         }
        //     });
        // },

        /**
         *  Enable Button.
         */
        enableButton: function($source) {
            $(':input[type="submit"]').prop("disabled", true);
            $(':input[name="Clear"]').prop("disabled", true);

            $('input[type="text"]').keyup(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
            $('input[type="text"]').change(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
            $source.find(".select-picker").change(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
            $source.find(".category-picker").change(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
            $source.find(".date-picker").click(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
            $source.find(".date-picker").change(function() {
                if ($(this).val() != "") {
                    $(':input[type="submit"]').prop("disabled", false);
                    $(':input[name="Clear"]').prop("disabled", false);
                }
            });
        },

        // /**
        //  * Change Direcyion question type.
        //  */
        // changeDirectionQuestionTypeTI: function($source) {
        //     $source.on("click", ".switch-direction-question-type", function() {
        //         var $this = $(this);
        //         var type = $this.val();
        //         var $question_row = $this.closest(".question-row");
        //         if (type == 1) {
        //             $question_row.find(".question-text").show();
        //             $question_row.find(".question-image").hide();

        //             //Add validation rules in direction question in english
        //             if ($("#en_direction_ques_type_text:checked").val() == 1) {
        //                 // Remove validation if direcction question type = 1
        //                 $("#en_direction_description_image").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#en_direction_description_text").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please enter direction question in english."
        //                     }
        //                 });
        //                 //------------------------------------
        //             } else {
        //                 // Remove validation if question type = 0
        //                 $("#en_direction_description_text").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#en_direction_description_image").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please select direction question image in english."
        //                     }
        //                 });
        //             }

        //             //Add validation rules in direction question in hindi
        //             if ($("#hn_direction_ques_type_text:checked").val() == 1) {
        //                 // Remove validation if direcction question type = 1
        //                 $("#hn_direction_description_image").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#hn_direction_description_text").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please enter direction question in hindi."
        //                     }
        //                 });
        //                 //------------------------------------
        //             } else {
        //                 // Remove validation if question type = 0
        //                 $("#hn_direction_description_text").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#hn_direction_description_image").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please select direction question image in hindi."
        //                     }
        //                 });
        //             }
        //         } else {
        //             $question_row.find(".question-text").hide();
        //             $question_row.find(".question-image").show();
        //             //Add validation rules in direction question in english
        //             if ($("#en_direction_ques_type_text:checked").val() == 1) {
        //                 // Remove validation if direcction question type = 1
        //                 $("#en_direction_description_image").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#en_direction_description_text").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please enter direction question in english."
        //                     }
        //                 });
        //                 //------------------------------------
        //             } else {
        //                 // Remove validation if question type = 0
        //                 $("#en_direction_description_text").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 if (
        //                     $("#en_direction_description_image_name").val() ==
        //                     ""
        //                 ) {
        //                     $("#en_direction_description_image").rules("add", {
        //                         required: true,
        //                         messages: {
        //                             required:
        //                                 "Please select direction question image in english."
        //                         }
        //                     });
        //                 } else {
        //                     $("#en_direction_description_image").rules(
        //                         "remove",
        //                         "required"
        //                     );
        //                 }
        //             }

        //             //Add validation rules in direction question in hindi
        //             if ($("#hn_direction_ques_type_text:checked").val() == 1) {
        //                 // Remove validation if direcction question type = 1
        //                 $("#hn_direction_description_image").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 $("#hn_direction_description_text").rules("add", {
        //                     required: true,
        //                     messages: {
        //                         required:
        //                             "Please enter direction question in hindi."
        //                     }
        //                 });
        //                 //------------------------------------
        //             } else {
        //                 // Remove validation if question type = 0
        //                 $("#hn_direction_description_text").rules(
        //                     "remove",
        //                     "required"
        //                 );

        //                 if (
        //                     $("#hn_direction_description_image_name").val() ==
        //                     ""
        //                 ) {
        //                     $("#hn_direction_description_image").rules("add", {
        //                         required: true,
        //                         messages: {
        //                             required:
        //                                 "Please select direction question image in hindi."
        //                         }
        //                     });
        //                 } else {
        //                     $("#hn_direction_description_image").rules(
        //                         "remove",
        //                         "required"
        //                     );
        //                 }
        //             }
        //         }
        //     });
        // },

        /**
         *  Date Time Picker
         */
        dateTimePicker: function($source) {
            var $datetime_picker = $source.find(".date-time-picker");

            if ($datetime_picker.length) {
                $datetime_picker.datetimepicker({
                    format: "DD-MM-YYYY HH:mm:ss"
                });
            }
        },

        dropify: function() {
            $('.dropify').dropify();
            $('.dropify').on("change",function(e) {
                var drEvent = $(this);
                drEvent = drEvent.data('dropify');
                var _imgExts = ["jpg", "jpeg", "png", "gif"];
                var fileName = e.target.files[0].name;
                var extension = fileName.substr( (fileName.lastIndexOf('.') +1) );
                var result = false;
                var i;
                if (extension) {
                    extension = extension.toLowerCase();
                    for (i = 0; i < _imgExts.length; i++) {
                        if (_imgExts[i].toLowerCase() === extension) {
                            result = true;
                            break;
                        }
                    }
                }
                if (!result) {

                    $(".extension-error").fadeIn(100);
                    drEvent.resetPreview();
                    drEvent.clearElement();
                }else{
                    $(".extension-error").fadeOut(200);
                }
            }) 
        }
    };
})();

Components.init();
