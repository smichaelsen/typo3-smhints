## TYPO3 Extension: Hints

* Extension Key: sm_hints
* Extension Author: Sebastian Michaelsen <sebastian@app-zap.de>
* Developed for: [Stiftung Mitarbeit](http://www.mitarbeit.de/)

## Description

Adds a new content element "hint", which basically provides an info box containing a symbol and some text. Symbol sets are fully configurable in the backend. The is extension is developed for and used in production by Stiftung Mitarbeit, Bonn, Germany.

## Requirements

Successfully tested with TYPO3 4.5 LTS and TYPO3 6.2.0beta2 LTS.

## Installation

* Create a storage folder in the pagetree for this extension.
* Install the extension via the extension manager.
* Open the extension's configuration form in the extension manager and provide the ID of the folder you just created.
* Include the extension's Static Typoscript Template ("Hints") into your TS Root Template.
* Open the Constant Editor, choose the section "sm_hints" and again provide the ID of the folder you just created.

## Usage

* Create Content Elements of the type "Hint type" in your storage folder.
* Create Content Elements of the type "Hint" on your content pages.