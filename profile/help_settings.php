<?php 
    require_once 'sidebar.php'
?>

                <div class="faqs settingsFAQs">
                    <div class="faqBody settingsFAQBody">
                        <h2>FAQs</h2>
                        <ul class="faqLinks settingsFAQLinks">
                            <li><p id="settings_faq_1" onclick="faq_handler(this.id)">How can I change my account information?</p></li>
                            <li><p id="settings_faq_2" onclick="faq_handler(this.id)">Why am I getting an error message when changing my account information?</p></li>
                        </ul>
                        <a href="help_main.php"><button class="backBtn">Back</button></a>
                        <div id="settings_faq_answer_1" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: How can I change my account information?</h3>
                            <p>To change your account information, head to the 'Settings' tab and type in the text boxes 
                                the information you want to change. After you type the info you want changed, press
                                'Update Information'.
                            </p>
                            <p>To change your password, you will need to do the following:</p>
                            <ul>
                                <li>Type in the password you currently use in the text box under the 'Current Password' label.</li>
                                <li>Type in the new password in the text box under the 'New Password' label.</li>
                                <li>Re-type the new password in the text box next to the new password.</li>
                                <li>Press 'Update Password'.</li>
                            </ul>
                        </div>
                        <div id="settings_faq_answer_2" class="faq_answer">
                            <i class="fa-solid fa-x" onclick="faq_close()"></i>
                            <h3>FAQ: Why am I getting an error message when changing my account information?</h3>
                            <p>You might receive an error when changing your account information if:</p>
                            <ul>
                                <li>The information you entered is invalid (contains invalid characters, improper spacing, no '@' symbol for the email, etc.).</li>
                                <li>The information you entered has been claimed by another user.</li>
                                <li>Some text fields have been erased or left blank.</li>
                                <li>Your current password entry is incorrect.</li>
                                <li>Your new password and re-entered password do not match.</li>
                                <li>There is an internal server issue.</li>
                            </ul>
                        </div>
                    </div>
                </div>

<?php
    require_once 'footer.php';
?>