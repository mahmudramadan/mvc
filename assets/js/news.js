let newsId = 0;
$("#news-form").submit(function () {
    let formData = $(this).serialize();
    let authorName = $("#author_id option:selected").text();
    submitForm(formData, authorName);
    return false;
});
$(document).on('click', ".delete-btn", function () {
    let btn = $(this);
    if (confirm("ِare you sure you want to delete this item?") === true) {
        deleteItem(btn);
    }
});
$(document).on('click', ".edit-btn", function () {
    let btn = $(this);
    newsId = parseInt(btn.attr("data-new-id"))
    getNewsItemData()
});

function getNewsItemData() {
    $.ajax({
        method: "get",
        url: BASE_URL + "edit-news/" + newsId,
        dataType: "json",
        success: function (response) {
            if (response.success === true) {
                renderNewsItemData(response.data[0]);
            } else {
                $("#form-result").html("<div class='alert alert-danger'>" + response.message + "</div>")
            }
        }
    })
}

function renderNewsItemData(data) {
    $("#title").val(data.title);
    $("#active").val(data.active);
    $("#author_id").val(data.author_id);
    $("#description").val(data.description);
    $("#open_modal_btn").click();
}

function submitForm(formData, authorName) {
    let actionUrl = newsId === 0 ? "add-news-item" : "update-news-item/" + newsId;
    $.ajax({
        method: "POST",
        data: formData,
        url: BASE_URL + actionUrl,
        dataType: "json",
        success: function (response) {
            if (response.success === true) {
                if (newsId > 0) {
                    updateRow(response.data, authorName);
                } else {
                    insertRow(response.data, authorName);
                    newsId = 0;
                }
                $(".close").click();
                $('#news-form').trigger("reset");
                $("#form-news-result").html("<div class='alert alert-success'> " + response.message + "</div>");
            } else {
                $("#form-news-result").html("<div class='alert alert-danger'>" + response.message + "</div>")
            }
            window.setTimeout(function () {
                $("#form-news-result").html("");
            }, 5000);
        }
    })
}

function insertRow(data, authorName) {
    $("table tbody").prepend(`
        <tr id="line_${data.id}">
            <td></td>
            <td class="news-title">${data.title}</td>
            <td class="news-author">${authorName}</td>
            <td class="news-active">${parseInt(data.active) === 1 ? "<b style='color: green'>active</b>" : "<b style='color: red'>un active</b>"}</td>
            <td>${data.created_at}</td>
            <td>
                <button type='button' class='btn btn-primary edit-btn' data-new-id='${data.id}'>edit</button>
                <button type='button' class='btn btn-danger delete-btn' data-new-id='${data.id}'>delete</button>
            </td></tr>`);

}

function updateRow(data, authorName) {
    let tr = $("#line_" + newsId);
    tr.find(".news-title").html(data.title);
    tr.find(".news-author").html(authorName);
    tr.find(".news-active").html(parseInt(data.active) === 1 ? "<b style='color: green'>active</b>" : "<b style='color: red'>un active</b>");
    newsId = 0;
}

function deleteItem(btn) {
    btn.attr("disabled", "disabled");
    $.ajax({
        method: "delete",
        url: BASE_URL + "delete-news-item/" + parseInt(btn.attr("data-new-id")),
        dataType: "json",
        success: function (response) {
            if (response.success === true) {
                $("#form-result").html("<div class='alert alert-success'> " + response.message + "</div>");
                btn.closest("tr").remove();
            } else {
                $("#form-result").html("<div class='alert alert-danger'>" + response.message + "</div>")
                btn.removeAttr("disabled");
            }
            window.setTimeout(function () {
                $("#form-result").html("");
            }, 10000);
        }
    })
}
