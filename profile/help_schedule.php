<?php 
    require_once 'sidebar.php'
?>

                <div class="faqs scheduleFAQs">
                    <div class="faqBody scheduleFAQBody">
                        <h2>FAQs</h2>
                        <ul class="faqLinks scheduleFAQLinks">
                            <li><p id="schedule_faq_1" onclick="faq_handler(this.id)">What is the schedule tab used for?</p></li>
                            <li><p id="schedule_faq_2" onclick="faq_handler(this.id)">Why is my schedule calendar blank?</p></li>
                        </ul>
                        <a href="help_main.php"><button class="backBtn">Back</button></a>
                        <div id="schedule_faq_answer_1" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>What is the schedule tab used for?</h3>
                            <p>After clicking on the schedule tab, you should see a calendar with days ranging from Monday to Friday.</p>
                            <p>This calendar will more easily display the user's classes (after the classes have been officially registered) 
                                in a weekly format with the start and end time.
                            </p>
                        </div>
                        <div id="schedule_faq_answer_2" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>Why is my schedule calendar blank?</h3>
                            <p>The schedule calendar for your account could be blank for one of two reasons:</p>
                            <ul>
                                <li>You have not yet registered your classes in your planner by clicking the 'Register' button.</li>
                                <li>Your classes have been deregistered by an admin account.</li>
                            </ul>
                        </div>
                    </div>
                </div>

<?php
    require_once 'footer.php';
?>