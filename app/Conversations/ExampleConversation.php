<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    public $pedido = [];
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Bienvenido a Subway, que deseas ordenar?")
            ->fallback('No se puede hacer una pregunta.')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Pan')->value('Pan'),
                Button::create('Wrap')->value('Wrap'),
                Button::create('Ensalada')->value('Ensalada'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->pedido['sub'] = $answer->getValue();
                $this->say('Sub seleccionado: '.$answer->getValue());
                $this->sizeSub();
            }
        });
    }

    public function sizeSub()
    {
        if ($this->pedido['sub'] === 'Pan') {
            $question = Question::create("Escoge el tamaño del pan")
            ->fallback('No se puede hacer una pregunta.')
            ->callbackId('ask_size')
            ->addButtons([
                Button::create('15 cm.')->value('15'),
                Button::create('30 cm.')->value('20'),
            ]);
            
            return $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->pedido['size'] = $answer->getValue();
                    $this->say('Tamaño seleccionado: '.$answer->getValue());
                    $this->say(json_encode($this->pedido));
                }
            });

        } else if($this->pedido['sub'] === 'Wrap') {
            $question = Question::create("Escoge el tamaño del pan")
            ->fallback('No se puede hacer una pregunta.')
            ->callbackId('ask_size')
            ->addButtons([
                Button::create('15 cm.')->value('15'),
                Button::create('30 cm.')->value('20'),
            ]);
            
            return $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->pedido['size'] = $answer->getValue();
                    $this->say('Gracias por pedir');
                }
            });


        } else {
            $question = Question::create("Escoge el tamaño del pan")
            ->fallback('No se puede hacer una pregunta.')
            ->callbackId('ask_size')
            ->addButtons([
                Button::create('15 cm.')->value('15'),
                Button::create('30 cm.')->value('20'),
            ]);
            
            return $this->ask($question, function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $this->pedido['size'] = $answer->getValue();
                    $this->say('Gracias por pedir');
                }
            });


        }
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
