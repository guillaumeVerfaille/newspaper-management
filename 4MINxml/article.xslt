<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxsl="urn:schemas-microsoft-com:xslt" exclude-result-prefixes="msxsl"
                xmlns:fo="http://www.w3.org/1999/XSL/Format"
>
    <xsl:output method="xml" indent="yes"/>

    <xsl:template match="/">
      <!--je démarre de la racine et j'ajoute mes rêgles de format de page ainsi que la page de garde-->
      <fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
        <fo:layout-master-set>

          <fo:simple-page-master master-name="A4" page-height="297mm" page-width="210mm" margin="20mm">
            <fo:region-body region-name="body" margin-top="15pt"/>
            <fo:region-before region-name="title" extent="10pt"/>
            <fo:region-after region-name="bas" extent="10pt"/>
          </fo:simple-page-master>

          <fo:page-sequence-master master-name="content">
            <fo:repeatable-page-master-reference master-reference="A4"/>
          </fo:page-sequence-master>
        </fo:layout-master-set>
        <fo:page-sequence master-reference="A4">
          <xsl:apply-templates/>
        </fo:page-sequence>
      </fo:root>
    </xsl:template>
  <xsl:template match="journal">
    <fo:flow flow-name="body">
    <xsl:apply-templates/>
    </fo:flow>
  </xsl:template>
  <xsl:template match="article">
    <xsl:apply-templates/>     
  </xsl:template>
  <xsl:template match="titre">
    <fo:block font-size="xx-large" text-align="center" color="blue">
      <xsl:value-of select="."/>
    </fo:block>
  </xsl:template>
  <xsl:template match="auteur">
    <fo:block font-size="x-large" color="green">
      Auteurs :
    </fo:block>
    <fo:block>
      <xsl:value-of select="."/>
    </fo:block>
  </xsl:template>
  <xsl:template match="contenu">
    <fo:block font-size="x-large" color="green">
      Contenu :
    </fo:block>
    <fo:block>
      <xsl:value-of select="."/>
    </fo:block>
  </xsl:template>
</xsl:stylesheet>
