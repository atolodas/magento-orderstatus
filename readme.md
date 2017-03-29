# Magento Orderstatus

It's a Magento module that allows to return order status

 
#### Instalation

Execute this steps from your magento's root path

```sh
$ git submodule add git@github.com:cammino/magento-orderstatus.git app/code/community/Cammino/Orderstatus
$ cp app/code/community/Cammino/Orderstatus/Cammino_Orderstatus.xml app/etc/modules
$ cp app/code/community/Cammino/Orderstatus/content.phtml app/design/adminhtml/default/default/template/orderstatus/content.phtml
$ cp app/code/community/Cammino/Orderstatus/order_notify_change.html app/locale/pt_BR/template/email
$ cp app/code/community/Cammino/Orderstatus/orderstatus.xml app/design/adminhtml/default/default/layout
```
#### Configuration

Go to "admin > system > configuration > Status do Pedido > Configuração" and set email that will receive notifications when order change status

**Cammino Digital**