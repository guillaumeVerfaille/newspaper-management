# Laboratoire d'OS : Développement d'un chat textuel
## Comment utiliser le tchat ?
### Suivez les étapes suivantes:
1. **compiler les trois fichiers**

 Pour compiler un fichier codé en C. Il faut exécuter la commande `gcc votre_fichier_d_entree.c -o votre_fichier_de_sortie.out` depuis le terminal. Par exemple: `gcc server.c -o server.o`

2. **Exécuter le fichier server.out**

 Dans votre terminal linux, entrez la commande suivante :  `sudo ./server.out`
 
 Il est important d'exécuter le fichier **server.out** car il crée les deux queues qui permettent d'envoyer et de reçevoir des messages.
3. **Exécuter les fichiers blabla.out et blabla2.out**

 Dans chacun des deux terminaux linux, entrez la commande suivante :  `sudo ./blabla.out` ou `sudo ./blabla2.out`
 
 Chacun de ces deux fichiers va créer le chat pour son utilisateur. C'est pourquoi, il faut exécuter les fichiers sur deux terminaux différents.
4. **Voila c'est prêt**
  
 Vous pouvez maintenant communiquer entre deux utilisateurs différents.
