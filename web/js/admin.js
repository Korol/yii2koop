function delProductPhoto(modelId, photoId){
    //console.log(modelId+' : '+photoId);
    $.post(
        '/admin/product/delphoto',
        { model : modelId, photo : photoId, _csrf : '<?=Yii::$app->request->getCsrfToken();?>' },
        function(data){
            if(data*1 == 1){
                $('#pf_'+photoId).hide('slow');
            }
        },
        'text'
    );
}