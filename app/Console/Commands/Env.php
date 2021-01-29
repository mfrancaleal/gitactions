<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Env extends Command
{
    private $actions;
    private $contents_env;
    private $contents_env_example;
    /**
     * The name and signature of the console line.
     *
     * @var string
     */
    protected $signature = 'env:edit {type?} {--line=default} {--newLine=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit the files .env and .env.example';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //Make array to methods
        $this->actions =[
            'a' => 'add',
            'r' => 'remove',
            'c' => 'commentary',
            'u' => 'uncomment',
            'e' => 'edit',
            'h' => 'help'
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(!$this->loadFiles()) exit;

        $type = $this->argument('type');
        $line = $this->option('line');
        $newLine = $this->option('newLine');

        if ($line=='default' && !$type) {
            $this->copy();
        }
        else{
            $method = $this->actions[$type];
            if($type == 'e')
                $this->$method($this->cleanLine($line),$this->cleanLine($newLine));
            else
                $this->$method($this->cleanLine($line));
        }
    }

    private function copy(){
        if(!copy('.env', '.env.example')){
            $this->error('Não foi possível copiar os dados para o arquivo .env.example.');
        }
        $this->info('Dados copiados com sucesso!');
    }

    private function add($line)
    {
        if($line == 'default') {
            $this->error('Informe a linha a ser inserida');
            return;
        }
        if(strpos($this->contents_env,$line)){
            $this->error('A linha informada já existe no arquivo!');
            return;
        }
        try {
            #.env
            file_put_contents('.env',  "\n".$line,FILE_APPEND );
            #.env_example
            file_put_contents('.env.example',  "\n".$line,FILE_APPEND );
        }
        catch (\Exception $e){
            $this->error('Tivemos um problema ao adicionar a linha... '.$e->getMessage());
            return false;
        }
        $this->info('Linha adicionada com sucesso!');
        $this->clearConfig();
    }

    private function remove($line)
    {
        if(!strpos($this->contents_env,$line)){
            $this->error('A linha informada não existe no arquivo!');
            return;
        }
        try {
            #.env
            $contents = str_replace($line, '', $this->contents_env);
            file_put_contents('.env', preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $contents));
            #.env.example
            $contents = str_replace($line, '', $this->contents_env_example);
            file_put_contents('.env.example', preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $contents));
        }
        catch (\Exception $e){
            $this->error('Tivemos um problema ao remover a linha... '.$e->getMessage());
        }
        $this->info('Linha removida com sucesso!');
        $this->clearConfig();
    }

    private function commentary($line)
    {
        if($line=='default'){
            $this->error('Informe a linha a ser comentada');
            return false;
        }
        try {
            #.env
            $contents = str_replace($line, '#'.$line, $this->contents_env);
            file_put_contents('.env', preg_replace("/(\R){2,}/", "$1", $contents));
            #.env.example
            $contents = str_replace($line, '#'.$line, $this->contents_env_example);
            file_put_contents('.env.example', preg_replace("/(\R){2,}/", "$1", $contents));
        }
        catch (\Exception $e){
            $this->error('Tivemos um problema ao comentar a linha... '.$e->getMessage());
        }
        $this->info('Linha comentada com sucesso!');
        $this->clearConfig();
    }

    private function uncomment($line)
    {

        if($line=='default'){
            $this->error('Informe a linha a ser descomentada');
            return false;
        }
        try {
            #.env
            $contents = str_replace('#' . $line, $line, $this->contents_env);
            file_put_contents('.env', preg_replace("/(\R){2,}/", "$1", $contents));
            #.env.example
            $contents = str_replace('#' . $line, $line, $this->contents_env_example);
            file_put_contents('.env.example', preg_replace("/(\R){2,}/", "$1", $contents));
        }
        catch (\Exception $e){
            $this->error('Tivemos um problema ao decomentar a linha... '.$e->getMessage());
        }
        $this->info('Linha descomentada com sucesso!');
        $this->clearConfig();
    }

    private function edit($line, $newLine)
    {
        if(!strpos($this->contents_env,$line)){
            $this->error('A linha informada não existe no arquivo!');
            return;
        }
        if($line=='default' || $newLine=='default'){
            $this->error('Informe a linha a ser alterada e a nova linha');
            return false;
        }
        try {
            #.env
            $contents = str_replace($line, $newLine, $this->contents_env);
            file_put_contents('.env', $contents);
            #.env.example
            $contents = str_replace($line, $newLine, $this->contents_env_example);
            file_put_contents('.env.example', $contents);
        }
        catch (\Exception $e){
            $this->error('Tivemos um problema ao decomentar a linha... '.$e->getMessage());
            return false;
        }
        $this->info('Linha alterada com sucesso!');
        $this->clearConfig();
    }

    private function clearConfig(){
        try {
            Artisan::call('config:clear');
        }
        catch (\Exception $e){
            $this->error('Não foi possível executar config:clear, tente novamente ou execute manualmente');
        }
        $this->info('Configurações alteradas!');
    }

    private function cleanLine($string) {
        //input
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','(',')',',',';','|','!','#','$','%','&','?','~','^','>','<','ª','º','\\','\'');
        //output
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','','','','','','','','','','','','','','','','','','','','"');
        //return
        return str_replace($what, $by, $string);
    }

    private function loadFiles(){
        try{
            $this->contents_env = file_get_contents('.env');
        }
        catch (\Exception $e){
            $this->error('Erro ao carregar os arquivos .env');
            return false;
        }

        try{
            $this->contents_env_example = file_get_contents('.env.example');
        }
        catch (\Exception $e){
            $this->error('Erro ao carregar os arquivos .env.example');
            return false;
        }
        return  true;
    }

    private function help(){
        $this->info('---------------------');
        $this->line('Comando Env:edit');
        $this->info('---------------------');
        $this->info('');
        $this->info('Formato: type? --line=? --newLine=?');
        $this->line('');
        $this->line('type : Parâmetro não obrigatório que pode ser:');
        $this->info('      a => Adicionar linha');
        $this->info('      r => Remover linha');
        $this->info('      c => Comentar linha');
        $this->info('      u => Descomentar linha');
        $this->info('      e => Alterar linha');
        $this->line('');
        $this->line('--line= : Linha que deseja manipular. Ela será obrigatória quando informar \'type\'.');
        $this->info('Exemplo de criação de linha: php artisan env:edit a --line=PORT_METHOD_A=22');
        $this->line('');
        $this->line('--newLine= : Usado somente para alterar uma linha e deve ser informada como novo conteúdo para a linha existente. Ela será obrigatória quando \'type\' for \'e\'.');
        $this->info('Exemplo: php artisan env:edit e --line=PORT_METHOD_A=22 --newLine=PORT_METHOD_A=23');
        $this->info('');
        $this->line('Default - Se nenhum parâmentro for informado, o arquivo .env será copiado para o arquivo .env.example:');
        $this->info('Examplo: php artisan env:edit');
        $this->line('');
        $this->line('Aspas - Para as linhas que contenham aspas "", use apóstrofo \':');
        $this->line('');
        $this->line('Aspas - Para as linhas que contenham aspas "", use apóstrofo \':');
        $this->info('Exemplo: php artisan env:edit a --line=METHOD=\'true\'');
    }
}
