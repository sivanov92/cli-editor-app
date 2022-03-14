# CLI editor app with option to add commands

This is a command-line program with open code to extend

# Initializaton

```bash
composer dump-autoload
composer install
```

# Editor command patterns

This is how the editor accepts and parses the cli input

```
php editor flag 'command/paramenter1/parameter2/....parameterN/' otherArguments
```

1.The Php editor part initialize the script for the programe
2.The Falg must always follow the php editor next, and must contain a dash symbol in it ("-")
3.The command component is parsed pretty straightforwardly, and the first string in the "slashes /" is the command , followed by the command params separated each by /

4. The otherArguments are any other sort of params your code may need, can be several params divided by space, or in case of the substitution is the filename

The filname is always expected to be in the root folder

php editor -i 's/w/world2/' testfile.txt - test command

# The flags each have their own callables in the repository to handle the extra functionality

# Tests

Run the tests with
```bash
 vendor\bin\phpunit tests
```

Note that this command is for Windows , for Ubuntu it may look like this
```bash
 vendor\bin\phpunit tests
```
