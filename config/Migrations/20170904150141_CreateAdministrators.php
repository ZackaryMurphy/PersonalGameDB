<?php
use Migrations\AbstractMigration;

class CreateAdministrators extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('administrators');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 32,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 64,
            'null' => false,
        ]);
        $table->addIndex([
            'name',
        ], [
            'name' => 'NAME_INDEX',
            'unique' => true,
        ]);
        $table->addIndex([
            'email',
        ], [
            'name' => 'EMAIL_INDEX',
            'unique' => true,
        ]);
        $table->create();
    }
}
