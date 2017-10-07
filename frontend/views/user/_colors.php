






<script>
   function change(id,color)
    {
        $.ajax({
            url: '/ajax/changec',
            type:'POST',
            data:({id:id}),
            success:function (e) {
                $('.sidebar').css('background',color);
                $('.content').css('background',color);
                $('.ad').css('background',color);

            }
        })
    }
</script>









<div class="col-sm-2 col-md-2 "  id="<?=$model->id?>" style="cursor: pointer;box-shadow: 1px 1px 1px 1px;background: <?=$model->color?>;margin-right: 2px;margin-bottom: 5px" onclick="change(<?=$model->id?>,'<?=$model->color?>')">
<span style="color: white;font-size: 70%"><?=$model->name?></span>
</div>