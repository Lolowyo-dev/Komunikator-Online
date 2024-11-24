<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->config['title'] ?></title>
    <script>
    <?php if (isset($_SESSION['user'])) { ?>
    const userID = <?php echo json_encode($_SESSION['user']['id']); ?>;
    <?php } ?>
    </script>
    <?= $this->loadAssets() ?>
</head>

<body class="bg-gray-100">
    <div class="content">