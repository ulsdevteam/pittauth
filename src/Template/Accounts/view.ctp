<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Active Guest Accounts'), ['action' => 'index']) ?></li>

    </ul>
</nav>
<div id="printAccount" class="accounts view large-9 medium-8 columns content">
    <h3>Temporary Guest Password for Visitors to the University Library System</h3>
    <p><strong><?= h($account->firstname) ?> <?= h($account->lastname) ?>,</strong>
    <p>Welcome to the University Library System, University of Pittsburgh!</p>
    <p>You can access online resources with this temporary username and password:</p>
    <table class="vertical-table userpass">
        <tr>
            <th scope="row"><?= __('Username:') ?></th>
            <td><?= h($account->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password:') ?></th>
            <td><?= h($account->account->password) ?></td>
        </tr>

<div>
<table id="characterIdTable">
<tbody><tr><td colspan="2"><b>Character Identification</b></td></tr>
<tr><td>Upper Case:</td><td>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z</td></tr>
<tr><td>Lower Case:</td><td>a b c d e f g h i j k l m n o p q r s t u v w x y z</td></tr>
<tr><td>Numbers:   </td><td>0 1 2 3 4 5 6 7 8 9</td></tr>
</tbody></table>


You may use this temporary guest password at any public device in the ULS.  At the login prompt, enter your username and password to gain full access to electronic resources licensed to the University of Pittsburgh.  Your access will expire at the end of the day you received the password.<p></p><br>
<h4>GUIDELINES</h4>

<ol id="disclaimer">
  <li>Visitors with valid photo ID are eligible to receive a temporary guest password allowing full access to ULS electronic resources in the ULS.  Passwords will be issued only by full time staff at the Library Service Desk.</li>
  <li>Please be aware that, if your login is not being used, we reserve the right to reassign your access in times of high resource demand.</li>
  <li>You are expected to follow University of Pittsburgh policies regarding the use of computers and computing facilities, including abstaining from activity that infriges on copyright or on the privacy of others, or is fraudulent, distruptive or destructive.  These policies are found on the University of Pittsburgh's website at http://technology.pitt.edu/security/acceptable-computing-access-and-use and at http://www.cfo.pitt.edu/policies/policy/10/10-02-05.html</li>
  <li>There is no printing service available with a temporary guest password.  In some cases, the temporary guest access to electronic resources may not allow content to be downloaded.</li>
  <li>Remember to log off when you are not actively using resources.  If you do not, you may be held responsible for any activity by the next person using the public device.</li>
</ol>
</div>

</table>
</div>
