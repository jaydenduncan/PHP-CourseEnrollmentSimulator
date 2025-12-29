<?php 
    require_once 'sidebar.php'
?>

                <div class="faqs plannerFAQs">
                    <div class="plannerFAQBody">
                        <h2 class="plannerFAQHeader">FAQs</h2>
                        <ul class="plannerFAQLinks">
                            <li><p id="planner_faq_1" onclick="faq_handler(this.id)">How do I add a course to my cart?</p></li>
                            <li><p id="planner_faq_2" onclick="faq_handler(this.id)">Why is a class failing to add to my cart?</p></li>
                            <li><p id="planner_faq_3" onclick="faq_handler(this.id)">Why am I getting an empty input error?</p></li>
                            <li><p id="planner_faq_4" onclick="faq_handler(this.id)">How are the course classes categorized?</p></li>
                            <li><p id="planner_faq_5" onclick="faq_handler(this.id)">How do I delete a class from my cart?</p></li>
                            <li><p id="planner_faq_6" onclick="faq_handler(this.id)">Why is the 'Register' button missing from my planner?</p></li>
                        </ul>
                        <a href="help_main.php"><button class="backBtn">Back</button></a>
                        <div id="planner_faq_answer_1" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: How do I add a course to my cart?</h3>
                            To add a course to your cart your should do the following:
                            <ol>
                                <li>Click on the 'Planner' tab.</li>
                                <li>Click 'Add Course' at the top of the page.</li>
                                <li>Choose any available subject from the list of subjects. Then, click 'Next'.</li>
                                <li>Choose any available course from the list of courses. Then, click 'Next'.</li>
                                <li>Choose an available time slot for your chosen course. Then, click 'Add'.</li>
                                <li>If the class does not interfere with any other classes it should be added to your cart.</li>
                            </ol>
                        </div>
                        <div id="planner_faq_answer_2" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: Why is a class failing to add to my cart?</h3>
                            <p>If a class is not being succesfully added to your cart, it could be for various reasons:</p>
                            <ul>
                                <li>You are not choosing a valid option on a subpage (See FAQ 3).</li>
                                <li>The class you are trying to add has a time that interferes with one or more of the classes
                                    you already have in your cart.
                                </li>
                                <li>The class you are trying to add may cause your total credit hours to go over the limit (15 hours).</li>
                                <li>There is an issue with the server.</li>
                            </ul>
                        </div>
                        <div id="planner_faq_answer_3" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: Why am I getting an empty input error?</h3>
                            <p>When adding a class to your cart, make sure to select a valid option on each subpage of the planner.
                                For selections that have a long list of available options, you can also scroll through to select the 
                                best option for you.
                            </p>
                        </div>
                        <div id="planner_faq_answer_4" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: How are the course classes categorized?</h3>
                            <p>Each course will have classes with the following information given in your cart:</p>
                            <ul>
                                <li>Section Number</li>
                                <li>Instructor</li>
                                <li>Start and End Time</li>
                                <li>Active Days (MWF for classes held on Mondays, Wednesdays, and Fridays; TR for classes held
                                    on Tuesdays and Thursdays)</li>
                                <li>Number of Credits</li>
                            </ul>
                            <p>Each class will also be given a class type that determines how the class will be held. There are
                                three different class types:
                            </p>
                            <ul>
                                <li>INP (In-person)</li>
                                <li>HYB (Hybrid - 50% in-person and 50% online)</li>
                                <li>ONL (100% online)</li>
                            </ul>
                        </div>
                        <div id="planner_faq_answer_5" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: How do I delete a class from my cart?</h3>
                            <p>To delete a class that your have added to your cart just head to the 'Planner' tab and press
                                the trash can icon in the lower right corner of the class slot.
                            </p>
                        </div>
                        <div id="planner_faq_answer_6" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: Why is the 'Register' button missing from my planner?</h3>
                            <p>Once you gather all of the classes you want in your cart and press the 'Register' button, 
                                you will notice that it disappears from the screen. Your schedule will be officially set 
                                from the pool of classes in your cart. The only way to reverse your registered classes
                                will be through a separate admin account, so be sure you review the classes you have 
                                in your cart before you register.
                            </p>
                        </div>
                    </div>
                </div>

<?php
    require_once 'footer.php';
?>