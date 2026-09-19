<?php

namespace Controllers;

use App\http\Request;
use App\http\Response;
use DateTime;
use Src\Cache;
use Src\Validation;
use stdClass;

class ActivicyController
{
    public Validation $validation;

    public function __construct(
        public Request $request,
        public Cache $cache
    ) {
        $this->validation = new Validation;
    }

    public function getActivities()
    {
        $sanitizedInput = $this->validation->filterInput($this->request->query());
        $url = "https://api.github.com/users/{$sanitizedInput["username"]}/events";

        $header = [
            "User-Agent: beginner-github-user-activity",
            "Accept: application/vnd.github+json",
            "X-GitHub-Api-Version: 2026-03-10"
        ];

        $inCache = $this->checkCache($sanitizedInput["username"]);
        if ($inCache) {
            return json_decode($inCache);
        } else {
            $response = new Response($header, $url);
            $result = $response->send();
            if ($result["status_code"] === 200) {
                $this->eventFormat($result["events"]);
                $this->cache->set([
                    $sanitizedInput["username"] => $result["events"]
                ]);
                return $result["events"];
            } else {
                header("Location: /home");exit;
            }
        }
    }

    private function formatTime(stdClass $event): void
    {
        $event->created_at = (new DateTime($event->created_at))->format("m/d — h:i A");
    }

    private function removeWordEvent(stdClass $event): void
    {
        $event->type = str_replace("Event", "", $event->type);
    }

    private function eventFormat(array $events): void
    {
        foreach ($events as $event) {
            $this->formatTime($event);
            $this->removeWordEvent($event);
        }
    }

    private function checkCache(string $username)
    {
        $userinfo = $this->cache->get($username);
        if ($userinfo) {
            return $userinfo;
        } else {
            return false;
        }
    }
}