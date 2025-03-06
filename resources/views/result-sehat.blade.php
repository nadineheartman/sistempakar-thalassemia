<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Sehat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Kesimpulan Hasil Screening</title>
</head>

<style>
    body {
        background-color: #F6E1C3;
        font-family: roboto;
    }
</style>

<body>

    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <!--navbar-->
        @include('components.navbar')
        <!--navbar-->
        <!--isi kesimpulan sehat-->
        <h1 class="text-center !text-3xl login">KESIMPULAN</h1>
        <p class="text-red text-2xl font-semibold">ANDA SEHAT!</p>

        <h1
            style="text-align:center; color:#E61919; font-family:roboto; font-weight:bold; font-size:24px; margin-top:60px; margin-bottom:77px; text-shadow:1px 1px 2px #E9A178; line-height:40px;">
            Selamat, anda Tidak Menderita Thalassemia. Usahakan untuk tetap melakukan screening<br>terhadap pasangan
            anda sebelum melakukan pernikahan, untuk mencegah<br>terjadinya Thalassemia pada generasi anda selanjutnya.
        </h1>
        <!--isi kesimpulan sehat-->
        <!--button-->
        <button type="button" class="btn"
            style="box-shadow:7px 7px 2px #A84448; background-color:#E9A178; text-align:center; color:#A84448; font-family:roboto; font-weight:bold; font-size:22px; margin-top:5px; margin-left:500px; padding-top:5px; width:150px; height:60px; border-radius:40px; text-shadow:1px 1px 6px #F6E1C3;">CETAK</button>

        <button type="button" class="btn"
            style="box-shadow:7px 7px 2px #A84448; background-color:#E9A178; text-align:center; color:#A84448; font-family:roboto; font-weight:bold; font-size:22px; margin-top:-86px; margin-left:800px; padding-top:5px; width:150px; height:60px; border-radius:40px; text-shadow:1px 1px 6px #F6E1C3;">SELESAI</button>
        <!--button-->

        <!--footer-->
        @include('components.footer')
        <!--footer-->
    </body>

</html>
