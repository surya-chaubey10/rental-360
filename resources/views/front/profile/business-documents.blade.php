@section('page-style')
<link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" rel="stylesheet">
@endsection
<style>
    @keyframes down-btn {
        0% {
            bottom: 20px;
        }

        100% {
            bottom: 0px;
        }

        0% {
            opacity: 0;
        }

        100% {
            opaicty: 1;
        }
    }

    @-webkit-keyframes down-btn {
        0% {
            bottom: 20px;
        }

        100% {
            bottom: 0px;
        }

        0% {
            opacity: 0;
        }

        100% {
            opaicty: 1;
        }
    }

    @-moz-keyframes down-btn {
        0% {
            bottom: 20px;
        }

        100% {
            bottom: 0px;
        }

        0% {
            opacity: 0;
        }

        100% {
            opaicty: 1;
        }
    }

    @-o-keyframes down-btn {
        0% {
            bottom: 20px;
        }

        100% {
            bottom: 0px;
        }

        0% {
            opacity: 0;
        }

        100% {
            opaicty: 1;
        }
    }


    .category-name {
        font-family: sans-serif;
        width: -webkit-fill-available;
        text-align: center;
        font-size: 40px;
    }

    .card-category-2 ul,
    .card-category-3 ul,
    .card-category-4 ul,
    .card-category-5 ul .card-category-6 ul {
        padding: 0;
    }

    .card-category-2 ul li,
    .card-category-3 ul li,
    .card-category-4 ul li,
    .card-category-5 ul li,
    .card-category-6 ul li {
        list-style-type: none;
        display: inline-block;
        vertical-align: top;
    }

    .card-category-2 ul li,
    .card-category-3 ul li {
        margin: 10px 5px;
    }

    .fa {
        margin: 5px;
        cursor: pointer;
    }

    .fa-pencil:before {
        margin-left: 22px;
    }


    .card-category-1,
    .card-category-2,
    .card-category-3,
    .card-category-4,
    .card-category-5,
    .card-category-6 {
        font-family: sans-serif;
        margin-top: 50px;
        text-align: center;
    }

    .card-category-1 div,
    .card-category-2 div {
        display: inline-table;
    }

    .card-category-1>div,
    .card-category-2>div:not(:last-child) {
        margin: 10px 5px;
        text-align: left;
    }



    /* Basic Card */
    .basic-card {
        width: 420px;
        border-radius: 20px;
        position: relative;

        -webkit-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        -o-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
    }

    .basic-card .card-content {
        padding: 30px;
    }

    .basic-card .card-title {
        font-size: 15px;
        font-family: 'Open Sans', sans-serif;
    }

    .basic-card .card-text {
        line-height: 1.6;
    }

    .basic-card .card-link {
        padding: 25px;
        width: -webkit-fill-available;
    }

    .basic-card .card-link a {
        text-decoration: none;
        position: relative;
        padding: 10px 0px;
    }

    .basic-card .card-link a:after {
        top: 30px;
        content: "";
        display: block;
        height: 2px;
        left: 50%;
        position: absolute;
        width: 0;

        -webkit-transition: width 0.3s ease 0s, left 0.3s ease 0s;
        -moz-transition: width 0.3s ease 0s, left 0.3s ease 0s;
        -o-transition: width 0.3s ease 0s, left 0.3s ease 0s;
        transition: width 0.3s ease 0s, left 0.3s ease 0s;
    }

    .basic-card .card-link a:hover:after {
        width: 100%;
        left: 0;
    }


    .basic-card-aqua {
        background-image: linear-gradient(to bottom right, #eb0d40, #b90e35);
        height: 35vh;
    }

    .basic-card-aqua .card-content,
    .basic-card .card-link a {
        color: #fff;
        transition: 2s;

    }

    .basic-card-aqua .card-link {
        border-top: 1px solid #82c1bb;
    }

    .basic-card-aqua .card-link a:after {
        background: #fff;
    }

    .basic-card-lips {
        background-image: linear-gradient(to bottom right, #ec407b, #ff7d94);
    }

    .basic-card-lips .card-content {
        color: #fff;
    }

    .basic-card-lips .card-link {
        border-top: 1px solid #ff97ba;
    }

    .basic-card-lips .card-link a:after {
        background: #fff;
    }

    .basic-card-light {
        border: 1px solid #eee;
    }

    .basic-card-light .card-title,
    .basic-card-light .card-link a {
        color: #636363;
    }

    .basic-card-light .card-text {
        color: #7b7b7b;
    }

    .basic-card-light .card-link {
        border-top: 1px solid #eee;
    }

    .basic-card-light .card-link a:after {
        background: #636363;
    }

    .basic-card-dark {
        background-image: linear-gradient(to bottom right, #252525, #4a4a4a);
    }

    .basic-card-dark .card-title,
    .basic-card-dark .card-link a {
        color: #eee;
    }

    .basic-card-dark .card-text {
        color: #dcdcdcdd;
    }

    .basic-card-dark .card-link {
        border-top: 1px solid #636363;
    }

    .basic-card-dark .card-link a:after {
        background: #eee;
    }

    #document {
        width: 355px;
        height: 150px;
        float: left;
        display: flex;
    }
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!--Owner Document Card 1 -->
<a href="{{Route('docs')}}"> <i class="fa fa-plus-square" style="font-size:35px;"> </a></i>

<div class="card-category-1">
    <div class="basic-card basic-card-aqua">
        @foreach($dns as $document)
        <div class="card-content">
            <div>
                <span class="card-title">{{$document->bu_document1}}</span> <a href="{{Route('docs')}}"><i class="fa fa-pencil"></i></a>
                <a href='{{asset('/company/docs/'. $document->bu_document1)}}' download=""><i class="fa fa-eye"></i></a>
                <hr>
                <p class="card-text">Uploaded on : {{$document->updated_at}}</p>
                <hr>
                <p>Status: </p>
            </div>
            <div>


                <img class="doc_image" style="height:150px; width:355px;" src='{{asset('/company/docs/'. $document->bu_document1)}}' alt="{{$document->bu_document1}}">



            </div>
        </div>
    </div>
    @endforeach
    <!--Card 2 -->
    <div class="basic-card basic-card-aqua">
        @foreach($dns as $document)
        <div class="card-content">
            <div>
                <span class="card-title">{{$document->bu_document2}}</span> <a href="{{Route('docs')}}"><i class="fa fa-pencil"></i></a>
                <a href='{{asset('/company/docs/'. $document->bu_document2)}}' download=""><i class="fa fa-eye"></i></a>
                <hr>
                <p class="card-text">Uploaded on : </p>
                <hr>
                <p>Status: </p>
            </div>
            <div>
                <img class="doc_image" style="height:150px; width:355px;" src='{{asset('/company/docs/'. $document->bu_document2)}}' alt="{{$document->bu_document2}}">
            </div>
        </div>
    </div>
    @endforeach
    <!--Card 2 End -->
    <!--Card 3-->
    <div class="basic-card basic-card-aqua">
        @foreach($dns as $document)
        <div class="card-content">
            <div>
                <span class="card-title">{{$document->bu_document3}}</span> <a href="{{Route('docs')}}"><i class="fa fa-pencil"></i></a>
                <a href='{{asset('/company/docs/'. $document->bu_document3)}}' download=""><i class="fa fa-eye"></i></a>
                <hr>
                <p class="card-text">Uploaded on : </p>
                <hr>
                <p>Status: </p>
            </div>
            <div>
                <img class="doc_image" style="height:150px; width:355px;" src='{{asset('/company/docs/'. $document->bu_document3)}}' alt="{{$document->bu_document3}}">
            </div>
        </div>
    </div>
    @endforeach
    <!--Card 3 End-->
    <!--Card 4-->
    <div class="basic-card basic-card-aqua">
        @foreach($dns as $document)
        <div class="card-content">
            <div>
                <span class="card-title">{{$document->bu_document4}}</span> <a href="{{Route('docs')}}"><i class="fa fa-pencil"></i></a>
                <a href='{{asset('/company/docs/'. $document->bu_document4)}}' download=""><i class="fa fa-eye"></i></a>
                <hr>
                <p class="card-text">Uploaded on : </p>
                <hr>
                <p>Status: </p>
            </div>
            <div>
                <img class="doc_image" style="height:150px; width:355px;" src='{{asset('/company/docs/'. $document->bu_document4)}}' alt="{{$document->bu_document4}}">
            </div>
        </div>
    </div>
    @endforeach
    <!--Card 4 End-->
    <!--Card 5-->
    <div class="basic-card basic-card-aqua">
        @foreach($dns as $document)
        <div class="card-content">
            <div>
                <span class="card-title">{{$document->bu_document5}}</span> <a href="{{Route('docs')}}"><i class="fa fa-pencil"></i></a>
                <a href='{{asset('/company/docs/'. $document->bu_document5)}}' download=""><i class="fa fa-eye"></i></a>
                <hr>
                <p class="card-text">Uploaded on : </p>
                <hr>
                <p>Status: </p>
            </div>
            <div>
                <img class="doc_image" style="height:150px; width:355px;" src='{{asset('/company/docs/'. $document->bu_document5)}}' alt="{{$document->bu_document5}}">
            </div>
        </div>
    </div>
    @endforeach
    <!--Card 5 End-->




</div>
<!-- Document Tabs end -->
<script>
    $(".doc_image").each(function() {

        var src = $(this).attr('src');
        var ext = src.split('.').pop();

        if (ext == 'pdf') {
            $(this).attr('src', '/company/docs/docs.png');
        } else if (ext == 'jpg' || ext == 'png' || ext == 'jpeg') {
            $(this).attr('src', '/company/docs/'.src);
        } else {
            $(this).attr('src', '/company/docs/file.png');
        }
    });
</script>
<script>
    function showText(toggleText) {
        toggleText.classList.toggle("active");
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>