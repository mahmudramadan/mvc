<html>
<head>
    <title><?= $data['title'] ?? "Blog"; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <meta name="csrf-token" content="<?= $_SESSION["token"] ?? "" ?>">
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 3px;
        }

        .container {
            margin-top: 58px;
        }
    </style>
</head>
<body>
