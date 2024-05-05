$(document).ready(function(){
    $("table").on('click', '.btnDelete', function () {
        let id = $(this).closest('tr')[0].cells[0].innerText;
        $.post("delete.php",{'id': id});
        $(this).closest('tr').remove();
    });

    $("table").on('click', '.btnUpdate', function () {
        let tableId = $(this).closest('tr')[0].cells[0].innerText;
        let tableTitle = $(this).closest('tr')[0].cells[1].innerText;
        let tableAuthor = $(this).closest('tr')[0].cells[2].innerText;
        let tableNumberPages = $(this).closest('tr')[0].cells[3].innerText;
        let tableGenre = $(this).closest('tr')[0].cells[4].innerText;
        
        $(".update_form #id").val(tableId);
        $(".update_form #title").val(tableTitle);
        $(".update_form #author").val(tableAuthor);
        $(".update_form #pages").val(tableNumberPages);
        $(".update_form #genre").val(tableGenre);
        
        if($(".update_form").css("display") === "none")
            $(".update_form").css("display", "inline");
        else
            $(".update_form").css("display", "none");
    });
});