<?php
namespace PersonalGames\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

/**
 * Administrators shell command.
 */
class AdministratorsShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->setDescription('A nifty backend tool to add administrators.');
        $parser->addOption('name', [
            'short' => 'n',
            'help' => 'The name of the administrator to add',
            'required' => true,
        ]);
        $parser->addOption('password', [
            'short' => 'p',
            'help' => 'The password for the new administrator',
            'required' => true,
        ]);
        $parser->addOption('email', [
            'short' => 'e',
            'help' => 'The email address for the new administrator',
            'required' => true
        ]);

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $params = [
            'name' => $this->param('name'),
            'password' => $this->param('password'),
            'email' => $this->param('email'),
        ];
        foreach ($params as $key => $value) {
            if (!$value) {
                $this->out($this->OptionParser->help());
                return $this->error("--$key is required to properly add an administrator");
            }
        }
        $admin = TableRegistry::get('Administrators');
        $new = $admin->newEntity();
        $new->name = $params['name'];
        $new->password = $params['password'];
        $new->email = $params['email'];

        if ($admin->save($new)) {
            $this->success('New administrator saved.');
            return;
        }

        return $this->error('There was a problem saving the new administrator. Errors: ' . $new->getErrors());
    }
}
