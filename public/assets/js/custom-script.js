var quill = new Quill('#quill-editor', {
    modules: {
        toolbar: "#quill-toolbar"
    },
    placeholder: "Type something",
    theme: "snow"
});
const imgInp = document.getElementById('imageUploader');
const imgOut = document.getElementById('imgOutput');
const imgOverlay = document.getElementById('imageOverlay');
if (imgInp) {
    imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
            imgOverlay.classList.add('show');
            imgOut.src = URL.createObjectURL(file);
        }
    }
}

var milestoneCount = 1;
function addMilestoneRow() {
    $('#milestoneInputBlock').append(
        '<div class="row col-md-12 mb-2" id="milstoneRow_' + milestoneCount + '"><div class="col-md-6 my-2"><input type="text" placeholder="Project Milestone" name="milestone_name[]" id="milestone_name_' + milestoneCount + '" class="form-control"></div><div class="col-md-5 my-2"><input type="number" class="form-control bidAmtItems" name="milestone_amt[]" id="milestone_amt_' + milestoneCount + '" placeholder="For" min="3" onchange="addMilestoneAmt()"></div><div class="col-md-1"><a href="javascript:void(0)" class="text-danger milestone_remove" id="' + milestoneCount + '"><i class="fa fa-times-circle"></i></a></div></div>'
    );
    milestoneCount++;
}
function bidPriceFun() {
    $('#bidPriceAmt').html($('#bidPrice').val());
}
var TotalMilestoneAmt = '';
calcSum();
function calcSum() {
    var myForm = $('#bidForm');
    var sum = 0;
    var itemsValue = myForm.find('.bidAmtItems');
    itemsValue.each(function () {
        var value = Number($(this).val());
        if (!isNaN(value)) sum += value;
    });
    $('#milestoneAmt').html(sum);
    TotalMilestoneAmt = Number(sum);
}

$(document).on('click', '.milestone_remove', function () {
    $('#milstoneRow_' + $(this).attr("id")).remove();
    calcSum();
});
function addMilestoneAmt() {
    calcSum();
    if (Number(TotalMilestoneAmt) > Number($('#bidPrice').val())) {
        alert("You Reached Your Actual Bid Amount Kindly reduced it.");
    } else {
        if (!$('#bidPrice').val() <= 0) {
            // calcSum();
            $('#milestoneError').css('display', 'none');
        } else {
            $('#milestoneError').html("Kindly first add the Bid Amount!")
        }
    }

};
// $("#bidForm").on("submit", function () {
//     alert("Submitted");
// });
$("#search_project_skills").select2({
    placeholder: 'You can find a list of projects registered with the expertise of the applicant / freelancer.',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});
$("#search_contest_skills").select2({
    placeholder: 'You can find a list of contest registered with the expertise.',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});
$("#post_project_skills").select2({
    placeholder: 'Please Add Your Porject Skills',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});
$("#post_contest_skills").select2({
    placeholder: 'Please Add Your Contest Skills',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});
$("#search_freelancer_skills").select2({
    placeholder: 'Search by Skills',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});

$(".portfolio-skills-tags").select2({
    placeholder: 'Please Add Your Portfolio Skills',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
});

$(".js-skills-tags").select2({
    placeholder: 'Please Add Your Skills',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
}).on('select2:close', function () {
    var element = $(this);
    var new_category = $.trim(element.val());
    console.log(new_category);
    if (new_category != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url: "/profile/skill/store",
            method: "POST",
            data: {
                keywords: new_category
            },
            success: function (data) {
                toastr.success('Skills Changed!', data);
            }
        })
    }
});

$(".js-certs-tags").select2({
    placeholder: 'Please Add Your Certifications',
    tags: true,
    createTag: function (params) {
        return {
            newTag: false
        }
    }
}).on('select2:close', function () {
    var element = $(this);
    var new_category = $.trim(element.val());
    console.log(new_category);
    if (new_category != '') {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url: "/profile/profCertification/store",
            method: "POST",
            data: {
                keywords: new_category
            },
            success: function (data) {
                toastr.success('Certification Changed!', data);
            }
        })
    }
});

$("#select_currency").change(function () {
    if ($(this).val() == "USD") {
        if ($('#hourlyRateRadio:checked').val() == "2") {
            $('#hourly_rates').empty();
            dollorRateArr = [
                "$7.5 - $10",
                "$10 - $20",
                "$20 - $30",
                "$30 - $50",
                "$ - $",
            ];
            dollorRateArr.forEach(ele => {
                $('#hourly_rates').append('<option value="' + ele + '" >' + ele + '</option>');
            });
        } else if ($('#fixedRateRadio:checked').val() == "1") {
            $('#fixed_rates').empty();
            dollorRateArr = [
                "$100 - $1000",
                "$1000 - $2000",
                "$2000 - $3000",
                "$3000 - $5000",
                "$5000 - $10000",
                "$ - $",
            ];
            dollorRateArr.forEach(ele => {
                $('#fixed_rates').append('<option value="' + ele + '" >' + ele + '</option>');
            });
        }

    } else if ($(this).val() == "KRW") {
        if ($('#hourlyRateRadio:checked').val() == "2") {
            $('#hourly_rates').empty();
            wonHourlyRateArr = [
                "₩7.5 - ₩10",
                "₩10 - ₩20",
                "₩20 - ₩30",
                "₩30 - ₩50",
                "₩ - ₩",
            ];
            wonHourlyRateArr.forEach(ele => {
                $('#hourly_rates').append('<option value="' + ele + '" >' + ele + '</option>');
            });
        } else if ($('#fixedRateRadio:checked').val() == "1") {
            $('#fixed_rates').empty();
            wonFixedRateArr = [
                "₩100 - ₩1000",
                "₩1000 - ₩2000",
                "₩2000 - ₩3000",
                "₩3000 - ₩5000",
                "₩5000 - ₩10000",
                "₩ - ₩",
            ];
            wonFixedRateArr.forEach(ele => {
                $('#fixed_rates').append('<option value="' + ele + '" >' + ele + '</option>');
            });
        }
    }
});

$("#fixed_rates").change(function () {
    if ($(this).val() == "$ - $" || $(this).val() == "₩ - ₩") {
        $('#min_budget').val("");
        $('#max_budget').val("");
        $('#custom_rates_block').css('display', 'flex');
    } else {
        $('#custom_rates_block').css('display', 'none');
    }
});

$("#hourly_rates").change(function () {
    if ($(this).val() == "$ - $" || $(this).val() == "₩ - ₩") {
        $('#min_budget').val("");
        $('#max_budget').val("");
        $('#custom_rates_block').css('display', 'flex');
    } else {
        $('#custom_rates_block').css('display', 'none');
    }
});

$("#hourlyRateRadio").change(function () {
    $('#select_currency').val("");
    $('#fixed_rates').empty();
    $('#fixed_rates').append('<option value="">First Select Currency / 먼저 통화 선택</option>');
    $("#fixed_rates").css('display', 'none');
    $("#custom_rates_block").css('display', 'none');
    $("#hourly_rates").css('display', 'block');
});
$("#fixedRateRadio").change(function () {
    $('#select_currency').val("");
    $('#hourly_rates').empty();
    $('#hourly_rates').append('<option value="">First Select Currency / 먼저 통화 선택</option>');
    $("#custom_rates_block").css('display', 'none');
    $("#fixed_rates").css('display', 'block');
    $("#hourly_rates").css('display', 'none');
});
$("#freelancerSearchForm").on("submit", function () {
    $('#selected_search_freelancer_skills').val($('#search_freelancer_skills').val());
});
$("#post_project_form").on("submit", function () {
    $('#selected_post_project_skills').val($('#post_project_skills').val());
    $('#project_description').val($('#quill-editor .ql-editor').html());
});
$("#post_contest_form").on("submit", function () {
    $('#selected_post_contest_skills').val($('#post_contest_skills').val());
    $('#contest_description').val($('#quill-editor .ql-editor').html());
});
$("#update_project_form").on("submit", function () {
    $('#update_project_description').val($('#quill-editor .ql-editor').html());
});
$("#update_contest_form").on("submit", function () {
    $('#update_contest_description').val($('#quill-editor .ql-editor').html());
});
$("#projectSearchForm").on("submit", function () {
    $('#selected_search_project_skills').val($('#search_project_skills').val());
});
$("#contestSearchForm").on("submit", function () {
    $('#selected_search_contest_skills').val($('#search_contest_skills').val());
});