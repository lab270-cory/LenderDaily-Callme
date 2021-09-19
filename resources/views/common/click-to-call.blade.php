<div>
    <a onclick="initiateCall()" class="btn waves-effect waves-light">Request a phone call</a>
</div>

<script>
    function initiateCall() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '{{route('twilio.initiate-call')}}', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        const urlParams = new URLSearchParams(window.location.search);
        xhr.send(JSON.stringify({
            phone_number: urlParams.get('phone_number')
        }));
    }

</script>

<style>
    .btn {
        display: inline-block;
        font-weight: 600;
        font-size: 12px;
        line-height: 30px;
        color: #545454;
        width: 120px;
        height: 30px;
        padding-bottom: 0!important;
        min-width: unset;
        margin-left: 0;
        border: unset;
        outline: 0;
        background: #fdb530 !important;
        border-radius: 15px !important;
        text-transform: capitalize;
        letter-spacing: -.4px;
    }

    a.waves-effect, a.waves-light {
        display: inline-block;
    }

    .btn {
        -webkit-transition: background-color .3s ease-in-out, color .3s ease-in-out;
        -o-transition: background-color .3s ease-in-out, color .3s ease-in-out;
        transition: background-color .3s ease-in-out, color .3s ease-in-out;
        display: inline-block;
        vertical-align: top;
        font-size: 18px;
        line-height: 1;
        font-weight: 700;
        border-radius: 24px;
        min-width: 202px;
        text-align: center;
        padding: 15px 20px;
        text-decoration: none;
        background-color: #feb612;
        color: #545454;
        cursor: pointer;
        text-transform: capitalize;
    }

    .btn {
        margin: .375rem;
        color: inherit;
        text-transform: uppercase;
        word-wrap: break-word;
        white-space: normal;
        cursor: pointer;
        border: 0;
        border-radius: .125rem;
        -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        -webkit-transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
        padding: .84rem 2.14rem;
        font-size: .81rem;
    }

    .waves-effect {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    a {
        color: #007bff;
        text-decoration: none;
        cursor: pointer;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

</style>
