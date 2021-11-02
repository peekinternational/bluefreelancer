jQuery(document).ready(function ($) {
    // =============================
    // ======= MODELS Logics =======
    // =============================

    // Hourly Rate Model
    $("#hourly-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            hourly_rate: jQuery('#hourly_rate').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/hourly_rate',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                // console.log(data);
                jQuery('#hourly_modal').modal('hide');
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
            }
        });
    });

    // Profession Headline Model
    $("#profession-headline-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            prof_headline: jQuery('#prof_headline').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/prof_headline',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#profession_headline_modal').modal('hide');
            },
            error: function (data) {
                console.log(data);
                toastr.error(data.responseJSON.message);
            }
        });
    });

    // Description Model
    $("#description-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            description: jQuery('#company_description').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/description',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#description_modal').modal('hide');
            },
            error: function (data) {
                console.log(data);
                toastr.error(data.responseJSON.message);
            }
        });
    });

    // Experience Model
    $("#experience-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        if (jQuery('#completion_at').val()) {
            document.getElementById("work_status").value = null;
        }
        var formData = {
            title: jQuery('#title').val(),
            companyname: jQuery('#companyname').val(),
            started_at: jQuery('#started_at').val(),
            completion_at: jQuery('#completion_at').val(),
            work_status: jQuery('#work_status').val(),
            summary: jQuery('#summary').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/experience',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#experience_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                } if (data.responseJSON.errors.companyname) {
                    toastr.error(data.responseJSON.errors.companyname);
                } if (data.responseJSON.errors.started_at) {
                    toastr.error(data.responseJSON.errors.started_at);
                } if (data.responseJSON.errors.summary) {
                    toastr.error(data.responseJSON.errors.summary);
                } else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Experience Update Model
    $("#experience-update-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        if (jQuery('#completion_at_update').val()) {
            document.getElementById("work_status_update").value = null;
        }
        var formData = {
            id: jQuery('#exp_id').val(),
            title: jQuery('#title_update').val(),
            companyname: jQuery('#companyname_update').val(),
            started_at: jQuery('#started_at_update').val(),
            completion_at: jQuery('#completion_at_update').val(),
            work_status: jQuery('#work_status_update').val(),
            summary: jQuery('#summary_update').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/experience/update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#experience_update_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                } if (data.responseJSON.errors.companyname) {
                    toastr.error(data.responseJSON.errors.companyname);
                } if (data.responseJSON.errors.started_at) {
                    toastr.error(data.responseJSON.errors.started_at);
                } if (data.responseJSON.errors.summary) {
                    toastr.error(data.responseJSON.errors.summary);
                } else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Education Model
    $("#education-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            country: jQuery('#country').val(),
            name: jQuery('#name').val(),
            subjects: jQuery('#subjects').val(),
            addmission_year: jQuery('#addmission_year').val(),
            grad_year: jQuery('#grad_year').val(),
        };
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/profile/education',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#education_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.country) {
                    toastr.error(data.responseJSON.errors.country);
                }
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.subjects) {
                    toastr.error(data.responseJSON.errors.subjects);
                }
                if (data.responseJSON.errors.addmission_year) {
                    toastr.error(data.responseJSON.errors.addmission_year);
                }
                if (data.responseJSON.errors.grad_year) {
                    toastr.error(data.responseJSON.errors.grad_year);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Education Update Model
    $("#education-update-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            id: jQuery('#edu_id').val(),
            country: jQuery('#country_update').val(),
            name: jQuery('#name_update').val(),
            subjects: jQuery('#subjects_update').val(),
            addmission_year: jQuery('#addmission_year_update').val(),
            grad_year: jQuery('#grad_year_update').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/education/update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#education_update_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.country) {
                    toastr.error(data.responseJSON.errors.country);
                }
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.subjects) {
                    toastr.error(data.responseJSON.errors.subjects);
                }
                if (data.responseJSON.errors.addmission_year) {
                    toastr.error(data.responseJSON.errors.addmission_year);
                }
                if (data.responseJSON.errors.grad_year) {
                    toastr.error(data.responseJSON.errors.grad_year);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Certification Model
    $("#certification-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            name: jQuery('#cert_name').val(),
            organization: jQuery('#organization').val(),
            description: jQuery('#description').val(),
            issue_date: jQuery('#issue_date').val(),
        };
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/profile/certification',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#certification_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.organization) {
                    toastr.error(data.responseJSON.errors.organization);
                }
                if (data.responseJSON.errors.issue_date) {
                    toastr.error(data.responseJSON.errors.issue_date);
                }
                if (data.responseJSON.errors.description) {
                    toastr.error(data.responseJSON.errors.description);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Certification update Model
    $("#certification-update-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            id: jQuery('#cert_id').val(),
            name: jQuery('#cert_name_update').val(),
            organization: jQuery('#organization_update').val(),
            description: jQuery('#description_update').val(),
            issue_date: jQuery('#issue_date_update').val(),
        };
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/profile/certification/update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#certification_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.organization) {
                    toastr.error(data.responseJSON.errors.organization);
                }
                if (data.responseJSON.errors.issue_date) {
                    toastr.error(data.responseJSON.errors.issue_date);
                }
                if (data.responseJSON.errors.description) {
                    toastr.error(data.responseJSON.errors.description);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Publication Model
    $("#publication-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            name: jQuery('#pub_name').val(),
            title: jQuery('#pub_title').val(),
            summary: jQuery('#pub_summary').val(),
        };
        $.ajax({
            type: 'POST',
            url: '/profile/publication',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#publication_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                }
                if (data.responseJSON.errors.summary) {
                    toastr.error(data.responseJSON.errors.summary);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Publication update Model
    $("#publication-update-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            id: jQuery('#pub_id').val(),
            name: jQuery('#pub_name_update').val(),
            title: jQuery('#pub_title_update').val(),
            summary: jQuery('#pub_summary_update').val(),
        };
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/profile/publication/update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#publication_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.name) {
                    toastr.error(data.responseJSON.errors.name);
                }
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                }
                if (data.responseJSON.errors.summary) {
                    toastr.error(data.responseJSON.errors.summary);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // Portfolio Model
    $("#portfolio-save-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData();
        formData.append('title', $('#port_title').val());
        formData.append('description', $('#port_description').val());
        formData.append('skills', $.trim($('#select_port_skills').val()));
        formData.append('image', $('#port_image')[0].files[0]);
        // console.log($('#port_image')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: '/profile/portfolio',
            data: formData,
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false,
            // dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#portfolio_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                }
                if (data.responseJSON.errors.description) {
                    toastr.error(data.responseJSON.errors.description);
                }
                if (data.responseJSON.errors.skills) {
                    toastr.error(data.responseJSON.errors.skills);
                }
                if (data.responseJSON.errors.image) {
                    toastr.error(data.responseJSON.errors.image);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });
    // Portfolio Model
    $("#portfolio-update-btn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData();
        formData.append('id', $('#port_id').val());
        formData.append('title', $('#port_title_update').val());
        formData.append('description', $('#port_description_update').val());
        formData.append('skills', $.trim($('#select_port_skills_update').val()));
        if ($('#port_image_update')[0].files[0]) {
            formData.append('image', $('#port_image_update')[0].files[0]);
        }
        $.ajax({
            type: 'POST',
            url: '/profile/portfolio/update',
            data: formData,
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false,
            // dataType: 'json',
            success: function (data) {
                toastr.success('Successfully', data);
                window.location.replace('/profile?edit_profile=1');
                jQuery('#portfolio_update_modal').modal('hide');
            },
            error: function (data) {
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                }
                if (data.responseJSON.errors.description) {
                    toastr.error(data.responseJSON.errors.description);
                }
                if (data.responseJSON.errors.skills) {
                    toastr.error(data.responseJSON.errors.skills);
                }
                if (data.responseJSON.errors.image) {
                    toastr.error(data.responseJSON.errors.image);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });
    // =========================================
    // ===== On Click Functions for Modals =====
    // =========================================

    // experience
    $('body').on('click', '#exp_UpModal_btn', function () {
        var exp_id = $(this).data('id');
        $.get('/profile/experience/edit/' + exp_id, function (data) {
            // const date = new Date(data.started_at)
            // console.log(date.toLocaleString(['af'], { year: 'numeric', month: '2-digit', day: 'numeric' }));
            // let started_at_date = date.toLocaleString(['af'], { year: 'numeric', month: '2-digit', day: 'numeric' });
            $('#exp_id').val(data.id);
            $('#title_update').val(data.title);
            $('#companyname_update').val(data.companyname);
            $('#started_at_update').val(data.started_at);
            $('#completion_at_update').val(data.completion_at);
            $('#summary_update').val(data.summary);
            if (data.work_status) {
                $('#work_status_update').attr('checked', 'checked');
                $('#completion_at_row_update').css('display', 'none');
            }
            $('#exp_update_modal').modal('show');
        })
    });
    // education
    $('body').on('click', '#edu_UpModal_btn', function () {
        var edu_id = $(this).data('id');
        $.get('/profile/education/edit/' + edu_id, function (data) {
            // console.log(data);
            $('#edu_id').val(data.id);
            $('#country_update').val(data.country);
            $('#name_update').val(data.name);
            $('#subjects_update').val(data.subjects);
            $('#addmission_year_update').val(data.addmission_year);
            $('#grad_year_update').val(data.grad_year);
            $('#education_update_modal').modal('show');
        })
    });
    // certifications
    $('body').on('click', '#cert_UpModal_btn', function () {
        var cert_id = $(this).data('id');
        $.get('/profile/certification/edit/' + cert_id, function (data) {
            // console.log(data);
            $('#cert_id').val(data.id);
            $('#cert_name_update').val(data.name);
            $('#organization_update').val(data.organization);
            $('#description_update').val(data.description);
            $('#issue_date_update').val(data.issue_date);
            $('#certification_update_modal').modal('show');
        })
    });
    // publications
    $('body').on('click', '#pub_UpModal_btn', function () {
        var pub_id = $(this).data('id');
        $.get('/profile/publication/edit/' + pub_id, function (data) {
            // console.log(data);
            $('#pub_id').val(data.id);
            $('#pub_name_update').val(data.name);
            $('#pub_title_update').val(data.title);
            $('#pub_summary_update').val(data.summary);
            $('#publication_update_modal').modal('show');
        })
    });
    // Portfolio
    $('body').on('click', '#port_UpModal_btn', function () {
        var port_id = $(this).data('id');
        $.get('/profile/portfolio/edit/' + port_id, function (data) {
            // console.log(data);
            $('#port_id').val(data.id);
            $('#port_title_update').val(data.title);
            $('#port_description_update').val(data.description);
            $('#port_old_img').attr('src', 'uploads/users/' + $('#port_user_id').val() + '/images/portfolio/' + data.image);
            $('#portfolio_update_modal').modal('show');
        })
    });

    // ==================================================================================
    // ===== Functions for Skills, Category, Sub Category and Certifications ============
    // ==================================================================================
    $.get('/category', function (data) {
        data.forEach(ele => {
            $('#project_select_category').append('<option value="' + ele.id + '" >' + ele.title + '</option>');
            $('#contest_select_category').append('<option value="' + ele.id + '" >' + ele.title + '</option>');
        });
    });

    $("#project_select_category").change(function (e) {
        $('#project_select_subcategory').empty();
        $('#project_select_subcategory').css('display', 'inline');
        $.get('/subcategory/show/' + $(this).val(), function (data) {
            data.forEach(ele => {
                $('#project_select_subcategory').append('<option value="' + ele.id + '" >' + ele.title + '</option>');
            });
        })
    });

    $("#contest_select_category").change(function (e) {
        $('#contest_select_subcategory').empty();
        $('#contest_select_subcategory').css('display', 'inline');
        $.get('/subcategory/show/' + $(this).val(), function (data) {
            data.forEach(ele => {
                $('#contest_select_subcategory').append('<option value="' + ele.id + '" >' + ele.title + '</option>');
            });
        })
    });

    $.get('/profile/skill', function (data) {
        data.forEach(ele => {
            $('#select_top_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#select_port_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#post_project_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#post_contest_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#search_project_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#search_contest_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
            $('#search_freelancer_skills').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
        });
    })

    $.get('/profile/profCertifications', function (data) {
        data.forEach(ele => {
            $('#select_top_certs').append('<option value="' + ele.id + '" class="select2-results__option select2-results__option--selectable select2-results__option--selected">' + ele.title + '</option>');
        });
    })

    // ==================================================================================
    // ======= On Click Functions for Proposal Approved & Rejected by Freelancer ========
    // ==================================================================================
    $('body').on('click', '#proposalAppBtn', function () {
        var proposal_id = $('#proposal_id').val();
        $.get('/project/my-project/' + proposal_id + '/proposal/approve', function (data) {
            toastr.success('Successfully Approved!', data);
            $('#proposalOptionRow').css('display', 'none');
            $('#projectSeleLastCol').append('<button type="submit" class="btn btn-sm btn-info mx-2 disabled">You Approved it!</button>');
        })
    });

    $('body').on('click', '#proposalRejBtn', function () {
        var proposal_id = $('#proposal_id').val();
        $.get('/project/my-project/' + proposal_id + '/proposal/reject', function (data) {
            console.log(data);
            toastr.error('Successfully Rejected!');
            $('#proposalOptionRow').css('display', 'none');
            $('#projectSeleLastCol').append('<button class="btn btn-sm btn-danger mx-2 disabled">You Rejected it!</button>');
        })
    });
    // ===================================================================================
    $('body').on('click', '#showcase_detail_btn', function () {
        var showcase_id = $(this).data('id');
        var user_id = $(this).data('user');
        $.get('/showcase/show/' + showcase_id, function (data) {
            $('#showcase_image_detail').attr('src', 'uploads/showcases/' + data.img);
            $('#showcase_title_detail').html(data.title);
            $('#showcase_category_detail').html(data.cate);
            $('#showcase_description_detail').html(data.description);
            $('#showcase_likes_count').html(data.showcase_likes.length);
            $('#showcase_liked_btn').attr('data-id', showcase_id);
            $('#showcase_unliked_btn').attr('data-id', showcase_id);

            if (data.showcase_likes.length == 0) {
                $('#showcase_unliked_btn').css('display', 'inline');
                $('#showcase_liked_btn').css('display', 'none');
            }
            data.showcase_likes.forEach(ele => {
                if (ele.user_id == user_id) {
                    $('#showcase_liked_btn').css('display', 'inline');
                    $('#showcase_unliked_btn').css('display', 'none');
                } else {
                    $('#showcase_unliked_btn').css('display', 'inline');
                    $('#showcase_liked_btn').css('display', 'none');
                }
            });
            $('#showcase_user_detail').html(data.user.username + ' - ' + data.user.country);
            $('#quikViewModal').modal('show');
        })
    });

    // ===================================================================================

    $('body').on('click', '#showcase_liked_btn', function () {
        var showcase_id = $(this).data('id');
        $.get('/showcase/unlike/' + showcase_id, function (data) {
            if (data) {
                $('#showcase_liked_btn').css('display', 'none');
                $('#showcase_unliked_btn').css('display', 'inline');
                var likes = Number($('#showcase_likes_count').html());
                $('#showcase_likes_count').html(likes - 1)
                toastr.success('Successfully Un-Liked!');
            }
        });
    });
    $('body').on('click', '#showcase_unliked_btn', function () {
        var showcase_id = $(this).data('id');
        $.get('/showcase/like/' + showcase_id, function (data) {
            if (data) {
                $('#showcase_liked_btn').css('display', 'inline');
                $('#showcase_unliked_btn').css('display', 'none');
                var likes = Number($('#showcase_likes_count').html());
                $('#showcase_likes_count').html(likes + 1)
                toastr.success('Successfully Liked!');
            }
        });
    });
    // ===================================================================================
    $('body').on('click', '#contest_entry_detail_btn', function () {
        var contest_id = $(this).data('id');
        $.get('/contest/entry/detail/' + contest_id, function (data) {
            // console.log(data);
            $('#contest_entry_image').attr('src', '../uploads/contest/entry/' + data.file);
            $('#contest_entry_title').html(data.title);
            $('#contest_entry_userFullname').html(data.user.name);
            $('#contest_entry_username').html('@' + data.user.username);
            $('#contest_entry_detail').html(data.detail);
            $('#contest_entry_detail_modal').modal('show');
        })
    });
    // ==============================
    // ======= Project Offer ========
    // ==============================
    $("#projectOfferBtn").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData();
        formData.append('title', $('#projectOfferTitle').val());
        formData.append('description', $('#projectOfferDescription').val());
        formData.append('currency', $('#projectOfferCurrency').val());
        formData.append('fixedRate', $('#projectOfferFixedRate').val());
        formData.append('budget', $('#projectOfferBudget').val());
        console.log($('#projectOfferTitle').val());
        $.ajax({
            type: 'POST',
            url: '/project/offer/' + $('#projectOfferOutsourcer').val(),
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                toastr.success('Project Offer Send Successfully!');
                // window.location.replace('/profile?outsourcer=' + $('#projectOfferOutsourcer').val());
                console.log(data);
                $('#projOfferMilestoneProjectId').val(data.bid.project_id);
                $('#projOfferMilestoneUserId').val(data.bid.user_id);
                $('#projOfferMilestoneBidId').val(data.bid.id);
                $('#payment-after-consulantation').attr('href', '/project-details/' + data.bid.project_id);
                jQuery('#projectOfferMilestoneModal').modal('show');
            },
            error: function (data) {
                // console.log(data);
                if (data.responseJSON.errors.title) {
                    toastr.error(data.responseJSON.errors.title);
                }
                if (data.responseJSON.errors.description) {
                    toastr.error(data.responseJSON.errors.description);
                }
                if (data.responseJSON.errors.currency) {
                    toastr.error(data.responseJSON.errors.currency);
                }
                if (data.responseJSON.errors.budget) {
                    toastr.error(data.responseJSON.errors.budget);
                }
                if (data.responseJSON.errors.fixedRate) {
                    toastr.error(data.responseJSON.errors.fixedRate);
                }
                else {
                    toastr.error("Please try again later!", "Server Error");
                }
            }
        });
    });

    // $("#projectOfferMilestoneDepositPayment").click(function (e) {
    //     // console.log("asdasdasd");
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     e.preventDefault();
    //     var formData = new FormData();
    //     formData.append('projOfferMsProjectId', $('#projOfferMilestoneProjectId').val());
    //     formData.append('projOfferMsUserId', $('#projOfferMilestoneUserId').val());
    //     formData.append('projOfferMsBidId', $('#projOfferMilestoneBidId').val());
    //     formData.append('projOfferMsAmount', $('#projOfferMilestoneAmount').val());
    //     formData.append('projOfferMsDescription', $('#projOfferMilestoneDescription').val());
    //     $.ajax({
    //         type: 'POST',
    //         url: '/project/offer/milestone-deposit',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function (data) {
    //             toastr.success('Project Payment Deposit Successfully!');
    //             window.location.replace('/project-details/' + data.project_id);
    //             // console.log(data);
    //         },
    //         error: function (data) {
    //             console.log(data);
    //             if (data.responseJSON.errors.projOfferMsAmount) {
    //                 toastr.error(data.responseJSON.errors.projOfferMsAmount);
    //             }
    //             if (data.responseJSON.errors.projOfferMsDescription) {
    //                 toastr.error(data.responseJSON.errors.projOfferMsDescription);
    //             }
    //             else {
    //                 toastr.error("Please try again later!", "Server Error");
    //             }
    //         }
    //     });
    // });

    $("#account-notify-freelancer").change(function (e) {
        $.get('/setting/account/notify-all-freelancer', function (data) {
            if(data.status == true){
                toastr.success('Notification set Successfully!');
            }
        })
    });

    $("#notifications-notify-projects").change(function (e) {
        $.get('/setting/account/notify-all-projects', function (data) {
            if(data.status == true){
                toastr.success('Notification set Successfully!');
            }
        })
    });

});