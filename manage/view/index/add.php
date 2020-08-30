<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加 - 导航管理</title>
    <!-- ZUI 标准版压缩后的 CSS 文件 -->
    <link rel="stylesheet" href="./assets/zui/css/zui.min.css">
    <!-- ZUI Javascript 依赖 jQuery -->
    <script src="./assets/zui/lib/jquery/jquery.js"></script>
    <!-- ZUI 标准版压缩后的 JavaScript 文件 -->
    <script src="./assets/zui/js/zui.min.js"></script>
</head>
<body>
<div class="nav">
    <?php include './view/menu.php'; ?>
</div>
<div class="nav-edit container-fluid">
    <!-- HTML 代码 -->
    <form class="form" action="?control=nav&action=save" method="post">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-control">
                    <input name="nav_name" type="text" class="form-control" placeholder="分类名称" required>
                </div>
            </div>
            <div class="col-xs-12">
                <select class="form-control" name="category_id" required>
                    <option value="">请选择分类</option>
                    <?php foreach ($category as $item): ?>
                        <option value="<?php echo $item['id']; ?>">|-- <?php echo $item['category_name']; ?></option>
                        <?php if (isset($item['sub_category'])): ?>
                            <?php foreach ($item['sub_category'] as $item): ?>
                                <option value="<?php echo $item['id']; ?>">
                                    |------ <?php echo $item['category_name']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <textarea name="nav_desc" class="form-control" rows="3" placeholder="描述" required></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6">
                <input name="nav_link" type="url" class="form-control" placeholder="链接" required>
            </div>
            <div class="col-xs-3">
                <select class="form-control" name="nav_target" required>
                    <option value="_parent">在父框架集中打开被链接文档</option>
                    <option value="_top">在整个窗口中打开被链接文档</option>
                    <option value="_blank" selected>在新窗口中打开被链接文档</option>
                    <option value="_self">默认。在相同的框架中打开被链接文档</option>
                </select>
            </div>
            <div class="col-xs-3">
                <input name="nav_sort" type="number" class="form-control" placeholder="排序" required>
            </div>

        </div>
        <br>
        <div class="row text-center">
            <button type="submit" class="btn btn-primary">添加</button>
            <button type="reset" class="btn">重置</button>
        </div>
    </form>
</div>

</body>
<script>
    $('form').on('submit', function (event) {
        $.ajax({
            url: '?control=nav&action=save',
            data: $('form').serializeArray(),
            dataType: 'json',
            method: 'POST',
            success: function (resp) {
                console.log(resp)
                if (resp.code == 0) {
                    new $.zui.Messager('添加成功。', {
                        type: 'success'
                    }).show();
                    setTimeout(function () {
                        window.location.href = '?control=nav&action=index'
                    }, 2000)
                } else {
                    new $.zui.Messager(resp.msg, {
                        type: 'danger'
                    }).show();
                }
            }
        })
        console.log(event)
        return false;
    })
</script>
</html>