<?php

namespace SoDe\Extend;

class Response
{
    public int $status;
    public string $message;
    public int $draw;
    public int $iTotalDisplayRecords;
    public int $iTotalRecords;
    public object|array|string|int|float|bool|null $data;

    public function __construct()
    {
        $this->status = 500;
        $this->message = 'Error inesperado';
    }

    public function toArray(): array
    {
        $json = json_encode($this);
        return json_decode($json, true);
    }

    public static function simpleTryCatch(callable $callback, ?callable $fallback = null): self
    {
        $response = new self();
        try {
            $data = $callback($response);
            if (isset($data)) {
                $response->data = $data;
            }
            if ($response->status === 500) {
                $response->status = 200;
            }
            if ($response->message === 'Error inesperado') {
                $response->message = 'Operación correcta';
            }
        } catch (\Throwable $th) {
            if ($fallback) $fallback($response, $th);
            $response->status = 400;
            $response->message = $th->getMessage();
        } finally {
            return $response;
        }
    }

    public function __toString(): string
    {
        return json_encode($this);
    }
}