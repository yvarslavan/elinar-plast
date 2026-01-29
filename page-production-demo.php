<?php
/**
 * Template Name: Production Cycle Demo
 * Description: Демонстрация двух вариантов блока "Полный цикл производства"
 */

get_header();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Полный цикл производства - Демо</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/production-cycle.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/production-cycle-cards.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        .demo-header {
            background: #1a1a1a;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .demo-header h1 {
            margin: 0 0 10px 0;
            font-size: 32px;
        }
        .demo-header p {
            margin: 0;
            opacity: 0.8;
        }
        .demo-divider {
            height: 60px;
            background: linear-gradient(180deg, #f5f5f5 0%, #ffffff 100%);
        }
        .variant-label {
            text-align: center;
            padding: 30px 20px 10px;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="demo-header">
    <h1>Полный цикл производства</h1>
    <p>Два варианта редизайна для промышленного сайта</p>
</div>

<!-- ВАРИАНТ 1: Progress Pipeline -->
<div class="variant-label">Вариант 1: Progress Pipeline (Технологическая линия)</div>
<?php include get_template_directory() . '/template-parts/production-cycle.php'; ?>

<div class="demo-divider"></div>

<!-- ВАРИАНТ 2: Industrial Cards -->
<div class="variant-label">Вариант 2: Industrial Cards (Промышленные карточки)</div>
<?php include get_template_directory() . '/template-parts/production-cycle-cards.php'; ?>

</body>
</html>

<?php
get_footer();
?>
