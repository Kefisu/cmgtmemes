<!-- Include head section -->
@include('layouts.partials._head')

<body>
<div id="app">

    <!-- Include header -->
@include('layouts.partials._header')

@include('inc.messages')

@yield('content')
<!-- Include lower half layout -->
    @include('layouts.partials._lower-half')

</div>
<script type="text/javascript">
    function featuredCheck() {
        // Get the checkbox
        var checkBox = document.getElementById("featured");
        var featuredForm = document.getElementById("featuredForm");

        // If the checkbox is checked, display the output text
        if (checkBox.checked === true){
            featuredForm.submit();
        } else {
            featuredForm.submit();
        }
    }
</script>
</body>
</html>
