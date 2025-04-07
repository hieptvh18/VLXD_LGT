$(document).ready(function () {
    let isFormDirty = false;

    // Khi có thay đổi trên form, đặt cờ isFormDirty = true
    $("#form-edit :input").change(function () {
        isFormDirty = true;
        console.log(isFormDirty)
    });

    // Khi bấm submit form, đặt lại isFormDirty = false
    $("#form-edit").submit(function () {
        isFormDirty = false;
    });

    // Kiểm tra khi người dùng cố gắng rời trang
    $(window).on("beforeunload", function () {
        if (isFormDirty) {
            return "Bạn có thay đổi chưa lưu, bạn có chắc muốn rời trang?";
        }
    });

    // Kiểm tra khi người dùng bấm vào liên kết hoặc nút chuyển trang
    $("a").on("click", function (event) {
        if (isFormDirty) {
            event.preventDefault(); // Chặn điều hướng
            let confirmLeave = confirm("Bạn có thay đổi chưa lưu, bạn có chắc muốn rời trang?");
            if (confirmLeave) {
                isFormDirty = false; // Cho phép rời trang nếu user xác nhận
                window.location.href = $(this).attr("href");
            }
        }
    });
});
