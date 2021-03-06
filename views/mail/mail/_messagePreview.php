<?php
/**
 * Shows a  preview of given $userMessage (UserMessage).
 * 
 * This can be the notification list or the message navigation
 */
$message = $userMessage->message;
?>

<li class="messagePreviewEntry_<?php echo $message->id; ?> messagePreviewEntry entry">

    <a href="javascript:loadMessage('<?php echo $message->id; ?>');">
        <div class="media">
        	<span class="profile-size-sm pull-left">
                <img class="media-object profile-size-sm img-rounded" data-src="holder.js/32x32" alt="32x32" style="width: 32px; height: 32px;" src="<?php echo $message->getLastEntry()->user->getProfileImage()->getUrl(); ?>">
                <div class="profile-overlay-img profile-overlay-img-sm"></div>
            </span>
            
            <div class="media-body">
                <h4 class="media-heading"><?php echo CHtml::encode($message->getLastEntry()->user->displayName); ?> <small><?php echo HHtml::timeago($message->updated_at); ?></small></h4>
                <h5><?php print CHtml::encode(Helpers::truncateText($message->title, 75)); ?></h5>
                <?php echo Helpers::truncateText(HMarkdownPreview::Render($message->getLastEntry()->content), 200); ?>
                <?php
                // show the new badge, if this message is still unread
                if ($message->updated_at > $userMessage->last_viewed AND $message->getLastEntry()->user->id <> Yii::app()->user->id) {
                    echo '<span class="label label-danger">' . Yii::t('MailModule.views_mail_index', 'New') . '</span>';
                }
                ?>
            </div>
        </div>
    </a>
</li>
