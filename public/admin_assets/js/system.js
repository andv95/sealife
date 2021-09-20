var prjSystems = {
    helpers: {
        getMetaContent: function (name) {
            return $("meta[name=" + name + "]").attr("content");
        },
        getCsrfToken: function () {
            return prjSystems.helpers.getMetaContent("csrf-token");
        },
        makeSlug: function (text) {
            if (text === undefined) {
                text = "";
            }

            //Đổi chữ hoa thành chữ thường
            var slug = text.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');

            return slug;
        },
        toggleOverlay: function (isShow) {
            if (isShow) {
                $("body #js_overlay_wrapper").addClass("overlay-wrapper").show();
            } else {
                $("body #js_overlay_wrapper").removeClass("overlay-wrapper").hide();
            }
        }
    },
    datatable: {
        make: function (table) {
            if (table.length) {
                const url = table.data('url');
                const columns = prjSystems.datatable.getColumns(table.data('cols'));
                const orderBy = (table.data("orderBy") ? table.data("orderBy").split(",") : [0, 'desc']);
                const filterIds = table.data("filterIds") ? table.data("filterIds").split(",") : [];

                if (url) {
                    const indexTable = table.DataTable({
                        ajax: {
                            url: url,
                            data: function (d) {
                                d._token = prjSystems.helpers.getCsrfToken();
                                $.each(filterIds, function (key, value) {
                                    d[value] = $("#" + value).val();
                                });
                            },
                            type: "POST",
                        },
                        lengthChange: true,
                        searching: true,
                        bFilter: true,
                        bSort: true,
                        info: true,
                        autoWidth: false,
                        select: true,
                        processing: true,
                        serverSide: true,
                        paging: true,
                        ordering: true,
                        responsive: true,
                        order: [orderBy],
                        /*columnDefs: [
                            {orderable: true}
                        ],*/
                        columns: columns,
                        language: {
                            "sEmptyTable": prjSystems.helpers.getMetaContent('navigation_empty'),
                            "sInfo": prjSystems.helpers.getMetaContent('navigation_sInfo'),
                            "sInfoEmpty": prjSystems.helpers.getMetaContent('navigation_sInfoEmpty'),
                            "sInfoFiltered": prjSystems.helpers.getMetaContent('navigation_sInfoFiltered'),
                            "sInfoPostFix": "",
                            "sInfoThousands": ",",
                            "sLengthMenu": prjSystems.helpers.getMetaContent('navigation_sLengthMenu'),
                            "sLoadingRecords": prjSystems.helpers.getMetaContent('navigation_sLoadingRecords'),
                            "sProcessing": prjSystems.helpers.getMetaContent('navigation_sProcessing'),
                            "sSearch": prjSystems.helpers.getMetaContent('navigation_sSearch'),
                            "sZeroRecords": prjSystems.helpers.getMetaContent('navigation_sZeroRecords'),
                            "paginate": {
                                "first": '<i class="fa fa-angle-double-right"></i>',
                                "previous": "<i class='fa fa-angle-double-left'></i>",
                                "next": '<i class="fa fa-angle-double-right"></i>',
                                "last": "<i class='fa fa-angle-double-left'></i>"
                            },
                            "oAria": {
                                "sSortAscending": prjSystems.helpers.getMetaContent('navigation_sSortAscending'),
                                "sSortDescending": prjSystems.helpers.getMetaContent('navigation_sSortDescending')
                            }
                        }
                    });

                    if (indexTable) {
                        $.each(filterIds, function (key, value) {
                            $("#" + value).on("change", function () {
                                indexTable.draw();
                            });
                        });
                    }

                    return indexTable;
                }
            }

            return false;
        },
        getColumns: function (columns) {
            var results = [];
            columns = columns ? columns.split(',') : [];

            for (var i = 0; i < columns.length; i++) {
                var columnName = $.trim(columns[i]);
                var columnNames = columnName.split(':');
                var columnConfigs = {};

                if (columnNames.length === 2) {
                    columnName = columnNames[0];
                    columnConfigs = {data: columnName, name: columnNames[1]};
                } else {
                    columnConfigs = {data: columnName, name: columnName};
                }

                if (columnName.substring(0, 7) === 'action_') {
                    columnConfigs.orderable = false;
                    columnConfigs.searchable = false;
                }

                results.push(columnConfigs);
            }

            return results;
        },
    },
    ckEditor: {
        make: function (id) {
            if (CKEDITOR.instances[id]) {
                CKEDITOR.instances[id].destroy();
            }

            CKEDITOR.replace(id, {
                height: 150,
                filebrowserImageBrowseUrl: '/file-manager/ckeditor'
            });

            return true;
        }
    },
    ajax: {
        make: function (url, data, method, button, success, error, successShowArea, ErrorShowArea) {
            const showOverLay = true;

            if (!url) {
                return false;
            }

            $.ajax({
                url: url,
                type: (method ? method : "GET"),
                data: data ? data : {},
                beforeSend: function () {
                    if (button) {
                        button.attr("disabled", true);
                    }

                    if (showOverLay) {
                        prjSystems.helpers.toggleOverlay(true);
                    }

                    $("#js_global_messages_area").html("");
                },
                success: function (data) {
                    if (data.isSuccess) {
                        if (success) {
                            success(data);
                        }
                    } else {
                        if (error) {
                            error(data);
                        } else {
                            $("#js_global_messages_area").html(data.messagesHtml);
                        }
                    }

                    prjSystems.init.afterAjax();
                },
                error: function (error) {
                    console.log(error);
                },
                complete: function () {
                    if (button) {
                        button.attr("disabled", false);
                    }

                    if (showOverLay) {
                        prjSystems.helpers.toggleOverlay(false);
                    }
                }
            })
        }
    },
    core: {
        getEditAddDataWhenChangeLang: function (languageSelect, renderHtml) {
            if (languageSelect === undefined) {
                return false;
            }

            //Clean html
            renderHtml.html("");

            return prjSystems.ajax.make(
                languageSelect.data('url'),
                {
                    language_key: languageSelect.val(),
                    id: languageSelect.data("id")
                },
                "GET",
                null,
                function (data) {
                    renderHtml.html(data.data);
                }
            );
        },
        /*ajaxFormSubmit(form) {
            const data = {};

            $.each(form.serializeArray(), function (key, item) {
                data[item.name] = item.value;
            });

            prjSystems.ajax.make(form.attr("action"), data, form.attr('method'), form.find("[type=submit]"));
        }*/
    },
    init: {
        documentReady: function () {
            //Datatable init
            prjSystems.datatable.make($(".js_datatable"));

            //Input checkbox on-off
            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            //Initialize Select2 Elements
            $('.select2').select2();

            /*CkEditor*/
            $('.editor').each(function () {
                prjSystems.ckEditor.make(this.id);
            });
        },
        afterAjax: function () {
            //Input checkbox on-off
            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            //Initialize Select2 Elements
            $('.select2').select2();

            /*CkEditor*/
            $('.editor').each(function () {
                prjSystems.ckEditor.make(this.id);
            });
        }
    },
    image: {
        editAdd: {
            remove: function (el) {
                const parent = el.closest(".js_edit_add_image_field");
                const existImage = parent.find(".js_edit_add_exist_image");
                const browseImageLabel = parent.find(".js_edit_add_image_browse").find("label");

                existImage.html("<p>" + existImage.data("label") + "</p>");
                browseImageLabel.html(browseImageLabel.data("label"));
                parent.find("input").val("");

            }
        }
    },
    nestable: {
        sortMenuItem: function () {
            $('#sort_menu').nestable({
                maxDepth: 3,
            }).on('change', function (e) {
                const list = e.length ? e : $(e.target);
                const messageArea = $("#js_global_messages_area");

                messageArea.html("");

                if (window.JSON) {
                    const json = window.JSON.stringify(list.nestable('serialize'));

                    prjSystems.ajax.make(
                        list.data("url"),
                        {serialize_data: json, _token: prjSystems.helpers.getCsrfToken()},
                        "POST",
                        null,
                        function (data) {
                            messageArea.html(data.messagesHtml);
                        },
                        function (error) {
                            messageArea.html(error.messagesHtml);
                        }
                    )

                } else {
                    alert('This browser is not supported for JSON.');
                }
            });
        }
    }
};
