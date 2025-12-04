<?php
/*
 * Simple REST helper class for setting HTTP response headers
 */
class SimpleRest {

    private $httpVersion = "HTTP/1.1";

    public function setHttpHeaders($contentType, $statusCode) {
        $statusMessage = $this->getHttpStatusMessage($statusCode);

        header("Access-Control-Allow-Origin: *");
        header($this->httpVersion . " " . $statusCode . " " . $statusMessage);
        header("Content-Type: " . $contentType);
    }

    public function getHttpStatusMessage($statusCode) {
        $httpStatus = [
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        ];

        return $httpStatus[$statusCode] ?? $httpStatus[500];
    }
}
?>
