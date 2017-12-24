<?php
use yii\helpers\Url;

?>
<script>
    function addRow<?= $class ?>() {
        var data = $('#add-<?= $relID?> :input').serializeArray();
        data.push({name: '_action', value : 'add'});
        $.ajax({
            type: 'POST',
            url: '<?php echo Url::to(['add-'.$relID]); ?>',
            data: data,
            success: function (data) {
                $('#add-<?= $relID?>').html(data);
                setTimeout(function() {
                    var rows=$('.kv-tabform-row').toArray();
                    console.log(rows.length);
                    $('#storagefactoritems-'+(rows.length-1)+'-product').select2('open');
                    $('#storagefactoritems-'+(rows.length-1)+'-product').focus();
                },100);
            }
        });
    }
    function delRow<?= $class ?>(id) {
        $('#add-<?= $relID?> tr[data-key=' + id + ']').remove();
    }
</script>
