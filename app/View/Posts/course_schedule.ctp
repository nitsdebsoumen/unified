<script>
    $('nav.navbar').removeClass('navbar-fixed-top').addClass('navbar-inner');
</script>

<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel')) ?>
            <div class="col-md-8">
                <div class="right_bar">
                    <h3>Course schedule</h3>
                    <div id='calendar'></div>
                </div>
            </div>               

        </div>
    </div>
</section>

<script>
    $(function () {
        $('#calendar').fullCalendar({
            defaultDate: new Date(),
            editable: true,
            eventLimit: false, // allow "more" link when too many events
            events: <?php echo $startdates; ?>
        });

    });
</script>