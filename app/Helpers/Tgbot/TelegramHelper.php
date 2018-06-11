<?php
//app/Helpers/Envato/User.php
namespace App\Helpers\Tgbot;
 
use Illuminate\Http\Request;
use App\User;
use App\Task;
use Ixudra\Curl\Facades\Curl;
 
class TelegramHelper
{

    public static function send_message($user_id, $message)
    {
        $user = User::find($user_id);

        if($user->chat_id == null)
        {
            return;
        }

        $api = env('TELEGRAM_API', false);
        $key = env('TELEGRAM_KEY', false);

        $string = $api . $key . "/sendmessage";

        $response = Curl::to($string)
            ->withData([
                'chat_id'    => $user->chat_id,
                'text'       => $message,
                'parse_mode' => 'Markdown'
            ])
            ->asJson()
            ->post();
    }

    public static function prepare_task($giver_id, $task_id, $deadline)
    {
        $prof = User::find($giver_id);
        $task = Task::find($task_id);

        $string  =  "You've got a new task!\n\n";
        $string .= "*" . $task->title . "*\n";
        $string .= $task->description . "\n\n";
        $string .= "*Deadline:* " . $deadline . "\n\n";
        $string .= "Pr. _" . $prof->name . " " . $prof->surname . "_";

        return $string;
    }

}