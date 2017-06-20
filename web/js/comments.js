/**
 * Created by rustam on 20.06.17.
 */
$(function(){
    $("a.reply").click(function() {
        var id = $(this).attr("id");
        $("#parent_id").attr("value", id);
    });
});