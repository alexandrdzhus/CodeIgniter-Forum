$(function () {

    init_events();

    $('#refresh').click(function () {
        $('#articles_body').data('xtable').reload();
    })

    var xtable = new Xtable('#articles_body');
    var xtable = new Xtable('#users_body');

});

//Clear modal window
function clear_modal_data() {
    $('.modal-title').html('');
    $('.modal-body').html('');
    $('#action').html('');
    $('#userModal').data('');
    $('.modal-error').html('');
}

//Create one ajax-request
function Ajax_send(obj) {
    $('.fon').css({'display': 'block'});
    $.ajax({
        url: obj.url,
        type: 'POST',
        data: obj.data,
        dataType: 'json',
        success: function (result) {
            var t = typeof result === 'object' && 'code' in result;
            if (t && result.code == 0) {
                obj.success(result);
            } else if (t && result.code == -1) {
                window.location = '/';
            } else if (t && result.code == -2) {
                alert('You do not have access');
            }else {
                alert('Other Error');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            obj.error(jqXHR, textStatus, errorThrown);
        },
        complete: function (jqXHR, textStatus) {
            $('.fon').css({'display': 'none'});
        }
    });
}

// Add button first
function init_add_section_click() {

    $('#send').click(function () {
        clear_modal_data();

        var url = 'articles/get_html_article';
        Ajax_send({
            url: url,
            data: '',
            success: function (result) {
                $('#userModal').modal('show');
                $('.modal-content').html(result.result.html);
                init_send_changes_add_button_click();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log();
            }
        });
    });
}

// Edit section first
function init_edit_button_click() {
    $('#articles_body').off('click', '.btn-update').on('click', '.btn-update', function () {
        var article_id = $(this).data("articleId");
        clear_modal_data();

        var url = '/articles/get_article';
        Ajax_send({
            url: url,
            data: {article_id: article_id},
            success: function (result) {
                $('#userModal').modal('show');
                $('.modal-content').html(result.result.html);
                init_send_changes_edit_button_click();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log();
            }
        })
    });
}

//Edit user first
function init_edit_user_button_click() {
    $('#users_body').off('click', '.btn-update').on('click', '.btn-update', function () {
        var user_id = $(this).data("userId");
        clear_modal_data();

        var url = '/users/get_user';
        Ajax_send({
            url: url,
            data: {user_id: user_id},
            success: function (result) {
                $('#userModal').modal('show');
                $('.modal-content').html(result.result.html);
                  init_send_changes_edit_user_button_click();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log();
            }
        })
    });
}

// Delete Section First
function init_show_modal_delete_buttons_click() {
    $('#articles_body').off('click', '.btn-del').on('click', '.btn-del', function () {
        var user_id = $(this).data("articleId");
        clear_modal_data();
        $('#userModal').modal('show');
        $('.modal-title').html('Delete post');
        $('.modal-body').html("Are you sure you want to delete this?");
        $('#action').html('Delete');
        $('#userModal').data('data', {user_id: user_id});
        init_delete_button_click();
    })
}

// Delete User First
function init_show_modal_delete_user_buttons_click() {
    $('#users_body').off('click', '.btn-del').on('click', '.btn-del', function () {
        var user_id = $(this).data("userId");
        clear_modal_data();
        $('#userModal').modal('show');
        $('.modal-title').html('Delete post');
        $('.modal-body').html("Are you sure you want to delete this?");
        $('#action').html('Delete');
        $('#userModal').data('data', {user_id: user_id});
        init_delete_user_button_click();
    })
}

function init_events() {
    init_add_section_click();
    init_show_modal_delete_buttons_click();
    init_show_modal_delete_user_buttons_click();
    init_edit_button_click();
    init_edit_user_button_click();
    init_load_files_click();

}
// Delete Section Two
function init_delete_button_click() {
    $('#action').off('click').on('click', function () {

        var user_id = $('#userModal').data('data').user_id;
        var url = '/articles/del_article';

        Ajax_send({
            url: url,
            data: {user_id: user_id},
            success: function (result) {
                $('.fon').css({'display': 'none'});
                $('#userModal').modal('hide');
                location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.fon').css({'display': 'none'});
            }
        })
    });
}

// Delete User Two
function init_delete_user_button_click() {
    $('#action').off('click').on('click', function () {

        var user_id = $('#userModal').data('data').user_id;
        var url = '/users/del_user';

        Ajax_send({
            url: url,
            data: {user_id: user_id},
            success: function (result) {
                $('.fon').css({'display': 'none'});
                $('#userModal').modal('hide');
                location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.fon').css({'display': 'none'});
            }
        })
    });
}

// Add new section two
function init_send_changes_add_button_click() {
    $('#action').off('click').on('click', function () {
        var newdata2 = $('form').serialize();
        var url = '/articles/add_article';

        Ajax_send({
            url: url,
            data: newdata2,
            success: function (result) {
                if (result.error) {
                    $('.modal-error').html(result['errors']).css({
                        'backgroundColor': '#F2DEDE',
                        'color': '#A94442',
                        'font-weight': 'bold',
                        'padding': '15px'
                    });
                } else {
                    $('.modal-error').html('ok');
                    $('#userModal').modal('hide');
                    location.reload(true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.fon').css({'display': 'none'});
                console.log();
            }
        })
    });
}

// Edit section two / Send changes
function init_send_changes_edit_button_click() {
    $('#action').off('click').on('click', function () {
        var newdata3 = $('form').serialize();
        var url = '/articles/edit_article';

        Ajax_send({
            url: url,
            data: newdata3,
            success: function (result) {
                $('#userModal').modal('hide');
                location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.fon').css({'display': 'none'});
                console.log();
            }
        })
    })
}

// Edit user two / Send changes
function init_send_changes_edit_user_button_click() {
    $('#action').off('click').on('click', function () {
        var newdata3 = $('form').serialize();
        var url = '/users/edit_user';

        Ajax_send({
            url: url,
            data: newdata3,
            success: function (result) {
                $('#userModal').modal('hide');
                location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.fon').css({'display': 'none'});
                console.log();
            }
        })
    })
}

// Upload files
function init_load_files_click() {
    $('#articles_body').on('afterpost', function() {
        $('.fileupload').fileupload({
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo(document.body);
                });
            }
            // progressall: function (e, data) {
            //     var progress = parseInt(data.loaded / data.total * 100, 10);
            //     $('.progress .bar').css(
            //         'width',
            //         progress + '%'
            //     );
            // }
        });
    });
};


function Xtable(target) {
    if (!$(target).length) {
        return;
    }
    this.target = target;
    $(target).data('xtable', this);
    this.initPaginationEvents();
    this.initPerPageChangeEvent();
    this.initSearchEvent();
    this.initSortEvent();
    this.reload();
}

Xtable.prototype.reload = function () {

    this.post(this.getParams());

};
Xtable.prototype.showPage = function (page) {

    var params = this.getParams();
    params.page = page;

    this.post(params);

};
Xtable.prototype.perPage = function (perPage) {

    var params = this.getParams();
    params.perPage = perPage;
    params.page = 1;

    this.post(params);

};
Xtable.prototype.search = function () {

    var params = this.getParams();
    params.page = 1;

    this.post(params);
};
Xtable.prototype.sortXtable = function () {

    var params = this.getParams();
    params.page = 1;

    this.post(params);
};

Xtable.prototype.post = function (data) {
    var that = this;

    $.ajax({
        url: $(this.target).data('url') + data.page,
        type: "POST",
        dataType: "json",
        data: data,
        success: function (result) {
            $(that.target).html(result.html);
            $(that.target).trigger("afterpost");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    });
};

Xtable.prototype.getParams = function () {

    var page = $(this.target + ' .ci-pagination-page-active').text() || 1;
    var perPage = $(this.target + ' #count_row').val();
    var keyword = $(this.target + ' .searchXtable').val();
    var sort = $(this.target + ' #sortXtable').val();

    var params = {
        page: page,
        perPage: perPage,
        keyword: keyword,
        sort: sort,

    };
    return params;
};
Xtable.prototype.initPaginationEvents = function () {
    var that = this;

    $(this.target)
        .off('click', '.pagination li a')
        .on('click', '.pagination li a', function (e) {
            e.preventDefault();
            var page = $(this).data("ci-pagination-page");

            that.showPage(page);
        });

};
Xtable.prototype.initPerPageChangeEvent = function () {
    var that = this;

    $(this.target)
        .off('change', '#count_row')
        .on('change', '#count_row', function () {
            var perPage = $(this).val();

            that.perPage(perPage);
        });
};

Xtable.prototype.initSearchEvent = function () {
    var that = this;

    $(this.target)
        .off('change', '.searchXtable')
        .on('change', '.searchXtable', function () {

            that.search();
        })
};

Xtable.prototype.initSortEvent = function () {
    var that = this;

    $(this.target)
        .off('change', '#sortXtable')
        .on('change', '#sortXtable', function () {

            that.sortXtable();
        })
};