<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tampilan SVG Responsif</title>
    <style>
        .svg-container {
            display: flex;
            justify-content: center;   /* posisikan di tengah horizontal */
            align-items: center;       /* posisikan di tengah vertical */
            padding: 20px;
        }

        .svg-container svg {
            width: 100%;       /* penuh mengikuti lebar layar */
            height: auto;      /* tinggi otomatis proporsional */
            max-width: 600px;  /* batas maksimal agar tidak terlalu besar */
            display: block;
            margin: 0 auto;    /* center */
        }
    </style>
</head>
<body>
    <div class="svg-container">
        @include('svg.party')
    </div>
</body>
</html>
