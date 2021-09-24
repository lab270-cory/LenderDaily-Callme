<div>
    <button id="request-phone-call" onclick="initiateCall()" class="btn waves-effect waves-light">Request a Phone Call</button>
</div>

<script>

    function initiateCall() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", '{{route('twilio.initiate-call')}}', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        const urlParams = new URLSearchParams(window.location.search);

        document.getElementById('request-phone-call').innerText = 'Loading...';
        document.getElementById('request-phone-call').setAttribute('disabled', '1');
        document.getElementById('request-phone-call').style.color = 'white';

        xhr.send(JSON.stringify({
            phone_number: urlParams.get('phone_number'),
            identifier: '{{Request::input('identifier')}}'
        }));

        xhr.onload = () => {
            document.getElementById('request-phone-call').innerText = 'Call Requested';
            document.getElementById('request-phone-call').style.color = 'inherit';
        };

        xhr.onerror = (err) => {
            document.getElementById('request-phone-call').style.color = 'inherit';
        };
    }

</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

    * {
        font-family: 'Roboto', sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #545454;
        margin: 0;
    }

    .btn.active {
        color: white;
    }

    .btn {
        display: inline-block;
        font-weight: 600;
        line-height: 30px;
        min-width: unset;
        padding: 1.5rem 3.5rem;
        border: unset;
        outline: 0;
        background: #fdb530 !important;
        letter-spacing: -.4px;
        font-size: 1.5rem;
        border-radius: 30px !important;
        width: 400px;
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
        text-decoration: none;
        background-color: #feb612;
        cursor: pointer;
    }

    .btn {
        color: inherit;
        /*text-transform: uppercase;*/
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
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    button {
        text-decoration: none;
        cursor: pointer;
        -webkit-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }

</style>
