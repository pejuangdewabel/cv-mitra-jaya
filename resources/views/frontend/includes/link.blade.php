<link rel="icon" type="image/x-icon" href="{{ asset('assets/frontend/images/Logo-new/printing-machine.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('assets/frontend/scss/main.css') }}" />
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    .whatsapp {
        font-family: Roboto, Arial, Sans-serif;
        font-size: 14px;
        font-weight: 400;
        right: 5%;
        position: fixed;
        bottom: 0;
        z-index: 999;
    }

    a {
        color: #fff;
        text-decoration: none;
        transition: ease-in-out .2s
    }

    a:hover {
        box-shadow: 0 1px 4px rgba(0, 0, 0, .12), 0 1px 3px rgba(0, 0, 0, .24);
        color: #fff
    }

    .icons {
        background: #25d366;
        border-radius: 10px 10px 0 0;
        display: block;
        height: 42px;
        margin-bottom: 20px;
        width: 220px
    }

    .icons:hover {
        background: #128c7e
    }

    .icons span {
        display: block;
        left: 5px;
        top: 5px;
        transform: translate(0, 10px)
    }

    svg {
        border-radius: 10px;
        display: block;
        fill: #fff;
        float: left;
        height: 42px;
        margin-right: 5px;
        -webkit-transition: ease-in-out .175s;
        transition: ease-in-out .175s;
        width: 42px
    }
</style>
