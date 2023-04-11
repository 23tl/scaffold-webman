<?php

namespace app\module\logs;


use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\NormalizerFormatter;
use Monolog\Utils;
use Webman\Http\Response;

class JsonLineFormatter extends LineFormatter
{
    public function format(array $record): string
    {

        $authorization = request()?->header('authorization');
        $url = request()?->fullUrl();
        $ua = request()?->header('User-Agent');
        $datetime = date('Y-m-d H:i:s');
        $referer = null;
        $cookies = json_encode(request()?->cookie(), JSON_THROW_ON_ERROR);
        $output = '{"app":,"'.config('app.name') .'" "authorization": "'. $authorization .'", "datetime": "' . $datetime . '", "timestamp": "%datetime%", "url": "' . $url . '", "UA": "' . $ua . '", "referer": "' . $referer . '", "uuid": %uuid%, "domain": "%domain%", "channel": "%channel%", "level": "%level_name%", "message": "%message%", "context": [%context%], "extra": %extra%, "cookies": ' . $cookies . '}' . "\n";
        //var_dump($output);
       // $vars = parent::format($record);
        $vars = NormalizerFormatter::format($record);
      //  var_dump($vars);
        foreach ($vars['extra'] as $var => $val) {
            if (false !== strpos($output, '%extra.'.$var.'%')) {
                $output = str_replace('%extra.'.$var.'%', $this->stringify($val), $output);
                unset($vars['extra'][$var]);
            }
        }

        foreach ($vars['context'] as $var => $val) {
            if (false !== strpos($output, '%context.'.$var.'%')) {
                $output = str_replace('%context.'.$var.'%', $this->stringify($val), $output);
                unset($vars['context'][$var]);
            }
        }

        if ($this->ignoreEmptyContextAndExtra) {
            if (empty($vars['context'])) {
                unset($vars['context']);
                $output = str_replace('%context%', '', $output);
            }

            if (empty($vars['extra'])) {
                unset($vars['extra']);
                $output = str_replace('%extra%', '', $output);
            }
        }

        foreach ($vars as $var => $val) {
            if (false !== strpos($output, '%'.$var.'%')) {
                $output = str_replace('%'.$var.'%', $this->stringify($val), $output);
            }
        }

        // remove leftover %extra.xxx% and %context.xxx% if any
        if (false !== strpos($output, '%')) {
            $output = preg_replace('/%(?:extra|context)\..+?%/', '', $output);
            if (null === $output) {
                $pcreErrorCode = preg_last_error();
                throw new \RuntimeException('Failed to run preg_replace: ' . $pcreErrorCode . ' / ' . Utils::pcreLastErrorMessage($pcreErrorCode));
            }
        }

        return $output;
    }
}