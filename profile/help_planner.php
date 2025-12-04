<?php 
    require_once 'sidebar.php'
?>

                <div class="faqs plannerFAQs">
                    <div class="plannerFAQBody">
                        <h2 class="plannerFAQHeader">FAQs</h2>
                        <ul class="plannerFAQLinks">
                            <li><p id="planner_faq_1" onclick="faq_handler(this.id)">How do I add a course to my cart?</p></li>
                        </ul>
                        <div id="planner_faq_answer_1" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <p>Click on the 'Planner' tab.</p>
                            <p>Click 'Add Course' at the top of the page.</p>
                            <p>Choose any available subject from the list of subjects. Then, click 'Next'.</p>
                            <p>Choose any available course from the list of courses. Then, click 'Next'.</p>
                            <p>Choose an available time slot for your chosen course. Then, click 'Add'.</p>
                            <p>If the class does not interfere with any other classes it should be added to your cart.</p>
                        </div>
                    </div>
                </div>

<?php
    require_once 'footer.php';
?>