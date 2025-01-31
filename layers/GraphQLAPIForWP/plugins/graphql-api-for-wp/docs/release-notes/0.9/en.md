# Release Notes: 0.9

This is the biggest release in the history of this plugin 🚀

These are all the changes added for version 0.9 of the GraphQL API for WordPress.

## Further completed the GraphQL Schema

The GraphQL schema mapping the WordPress data model has been significantly completed! 💪

![GraphQL schema](../../images/graphql-schema-v09.png)

Let's see what new elements have been added.

### In addition to `id`, fetch single entities by `slug`, `path` and other properties

Fields to fetch a single entity, such as `Root.post` or `Root.user`, used to receive argument `id` to select the entity. Now they have been expanded: `id` has been replaced with argument `by`, which is a oneof input object (explained later on) to query the entity by different properties.

The following fields have been upgraded, accepting the following properties in their `by` input:

- `Root.customPost`:
  - `id`
  - `slug`
- `Root.genericCustomPost`:
  - `id`
  - `slug`
- `Root.mediaItem`:
  - `id`
  - `slug`
- `Root.menu`:
  - `id`
  - `slug`
  - `location`
- `Root.page`:
  - `id`
  - `slug`
  - `path`
- `Root.postCategory`:
  - `id`
  - `slug`
- `Root.postTag`:
  - `id`
  - `slug`
- `Root.post`:
  - `id`
  - `slug`
- `Root.user`:
  - `id`
  - `username`
  - `email` (considered as “sensitive” data, so `Expose Sensitive Data in the Schema` must be enabled; see later on)

### Filter elements via the new `filter` field argument

In all fields retrieving a list of elements, such as `Root.posts` or `Root.users`, a new argument `filter` now allows us to filter the results. The filtering values are customized for each field, via a corresponding InputObject (see later on).

For instance, field `Root.posts` has argument `filter` of input object type `RootPostsFilterInput`, with these input fields:

```graphql
type RootPostsFilterInput {
  authorIDs: [ID!]
  authorSlug: String
  categoryIDs: [ID!]
  dateQuery: [DateQueryInput!]
  excludeAuthorIDs: [ID!]
  excludeIDs: [ID!]
  ids: [ID!]
  search: String
  status: [CustomPostStatusEnum!]
  tagIDs: [ID!]
  tagSlugs: [String!]
}
```

### Pagination and sorting fields are accessed via `pagination` and `sort` field args

All fields retrieving a list of elements can be paginated and sorted using customized InputObjects, and these are always placed under field arguments `pagination` and `sort` (in addition to `filter` for filtering).

For instance, field `Root.posts` now has this schema:

```graphql
type Root {
  posts(
    filter: RootPostsFilterInput
    pagination: PostPaginationInput
    sort: CustomPostSortInput
  ): [Post]!
}
```

### Filter custom post fields by tag, category, author and others

On fields to retrieve custom posts, such as:

- `Root.posts`
- `Root.customPosts`
- `Root.genericCustomPosts`
- `Root.myPosts`
- `User.posts`
- `PostCategory.posts`
- `PostTag.posts`

...added input fields for filtering the results:

- `tagIDs: [ID]`
- `tagSlugs: [String]`
- `categoryIDs: [ID]`
- `authorIDs: [ID]`
- `authorSlug: String`
- `excludeAuthorIDs: [ID]`
- `hasPassword: Bool` (considered as “sensitive” data)
- `password: String` (considered as “sensitive” data)

For instance, this query retrieves posts containing either tag `"graphql"`, `"wordpress"` or `"plugin"`:

```graphql
{
  posts(
    filter: {
      tagSlugs: ["graphql", "wordpress", "plugin"]
    }
  ) {
    id
    title
  }
}
```

### Exclude results via field arg `excludeIDs`

Added the field argument `excludeIDs` on all fields retrieving posts and custom posts, media items, users, comments, tags, categories and menus.

```graphql
{
  posts(
    filter: {
      excludeIDs: [1, 2, 3]
    }
  ) {
    id
    title
  }
}
```

### Filter by `metaQuery`

Custom posts, comments, users and taxonomies can now be filtered by meta, using the `metaQuery` input.

This input offers an enhancement over [how the `meta_query` args are provided](https://developer.wordpress.org/reference/classes/wp_meta_query/) (to functions `get_posts`, `get_users`, etc), in that type validations are strictly enforced in the GraphQL schema, and only the combinations that make sense are exposed. This is accomplished by using the newly-added oneof input object (explained later on) for input field `compareBy`, which offers 4 possible comparisons:

- `key`
- `numericValue`
- `stringValue`
- `arrayValue`

Depending on the chosen option, different data must be provided. For instance, filtering by `numericValue` we can use operator `GREATER_THAN`, by `arrayValue` we can use operator `IN`, and by `key` we can use operator `EXISTS` (and there's no need to provide a `value`).

We can pass several items under `metaQuery`, and decide if to do an `AND` or `OR` of their conditions by passing input `relation` on the first item in the list.

Concerning security, meta entries are by default not exposed. To make them accessible, their meta key [must be added to the corresponding allowlist](https://graphql-api.com/guides/config/querying-by-meta-values/), or an error will be returned.

Let's see some examples. This query filters posts where meta key `_thumbnail_id` exists:

```graphql
{
  posts(filter: {
    metaQuery: {
      key: "_thumbnail_id",
      compareBy:{
        key: {
          operator: EXISTS
        }
      }
    }
  }) {
    id
    title
    metaValue(key: "_thumbnail_id")
  }
}
```

This query filters users where meta `nickname` has a certain value:

```graphql
{
  users(filter: {
    metaQuery: {
      key: "nickname",
      compareBy:{
        stringValue: {
          value: "leo"
          operator: EQUALS
        }
      }
    }
  }) {
    id
    name
    metaValue(key: "nickname")
  }
}
```

This query filters comments where meta `upvotes` (which is an array of integers) has either values `4` or `5`:

```graphql
{
  comments(filter: {
    metaQuery: [
      {
        relation: OR
        key: "upvotes",
        compareBy: {
          arrayValue: {
            value: 4
            operator: IN
          }
        }
      },
      {
        key: "upvotes",
        compareBy: {
          arrayValue: {
            value: 5
            operator: IN
          }
        }
      }
  ]}) {
    id
    upvotes: metaValues(key: "upvotes")
  }
}
```

### Field `urlAbsolutePath`

Field `urlAbsolutePath` has been added to several types:

- `Post.urlAbsolutePath: URLAbsolutePath!`
- `Page.urlAbsolutePath: URLAbsolutePath!`
- `PostCategory.urlAbsolutePath: URLAbsolutePath!`
- `PostTag.urlAbsolutePath: URLAbsolutePath!`
- `User.urlAbsolutePath: URLAbsolutePath!`

For instance, if field `User.url` returns `"https://mysite.com/author/admin/"`, then field `User.urlAbsolutePath` returns `"/author/admin/"`.

```graphql
{
  users {
    id
    urlAbsolutePath
  }
}
```

### `content` fields are now of type `HTML`, and a new `rawContent` field of type `String` was added

The `content` fields are now of type `HTML`:

- `Post.content: HTML!`
- `Page.content: HTML!`
- `Comment.content: HTML!`

And a new `rawContent` of type `String` was introduced:

- `Post.rawContent: String!`
- `Page.rawContent: String!`
- `Comment.rawContent: String!`

### Converted from string to Enum type whenever possible

Since adding support for custom enum types (see later on), wherever possible (in fields, field/directive arguments and input types) enums are now used. This includes:

- Custom post type and status
- Comment type and status
- "Order by" property, for all entities
- Menu locations

### Custom posts

Added fields to retrieve the logged-in user's custom posts:

- `Root.myCustomPost: CustomPostUnion`
- `Root.myCustomPosts: [CustomPostUnion]!`
- `Root.myCustomPostCount: Int!`

Added fields to all custom post entities (`Post`, `Page`, etc):

- `modifiedDate: DateTime`
- `modifiedDateStr: String`

### Posts

Added fields to the `Post` type:

- `postFormat: String!`
- `isSticky: Bool!`

### Pages

Added fields to `Page` to fetch the parent and children, and the menu order:

- `parent: Page`
- `children: [Page]!`
- `childCount: Int!`
- `menuOrder: Int!`

Filter field `pages` via new inputs:

- `parentIDs: [ID]`
- `parentID: ID`

```graphql
{
  pages(
    filter: {
      parentID: 0
    }
    pagination: {
      limit: 30
    }
  ) {
    ...PageProps
    children(
      filter: {
        search: "html"
      }
    ) {
      ...PageProps
      children(
        pagination: {
          limit: 3
        }
      ) {
        ...PageProps
      }
    }
  }
}

fragment PageProps on Page {
  id
  title
  date
  urlAbsolutePath
}
```

### Comments

Added fields to retrieve comments and their number:

- `Root.comment: Comment`
- `Root.comments: [Comment]!`
- `Root.commentCount: Int!`
- `Root.myComment: Comment`
- `Root.myComments: [Comment]!`
- `Root.myCommentCount: Int!`
- `CustomPost.commentCount: Int!`
- `Comment.responseCount: Int!`

Added input fields to filter comments:

- `authorIDs: [ID!]`
- `customPostID: ID!`
- `customPostIDs: [ID!]`
- `excludeCustomPostIDs: [ID]`
- `customPostAuthorIDs: [ID!]`
- `excludeCustomPostAuthorIDs: [ID]`
- `customPostTypes: [String!]`
- `dateQuery: [DateQueryInput]`
- `excludeAuthorIDs: [ID]`
- `excludeIDs: [ID!]`
- `ids: [ID!]`
- `parentID: ID!`
- `parentIDs: [ID!]`
- `excludeParentIDs: [ID]`
- `excludeIDs: [ID!]`
- `search: String`
- `types: [String!]`

### Comment Mutations

Non logged-in users can now also create comments (previously, the mutation returned an error if the user was not logged-in):

```graphql
mutation {
  addCommentToCustomPost(input: {
    authorEmail: "leo@test.com"
    authorName: "Leo"
    authorURL: "https://leoloso.com"
    comment: "Hola sarola!"
    customPostID: 1
  }) {
    id
    date
    content
  }
}
```

### Users

Query properties for users:

- `User.nicename: String!`
- `User.nickname: String!`
- `User.locale: String!`
- `User.registeredDate: String!`

### User roles

Added functional fields to better operate with user roles:

- `User.roleNames: [String]!`
- `User.hasRole: Bool!`
- `User.hasAnyRole: Bool!`
- `User.hasCapability: Bool!`
- `User.hasAnyCapability: Bool!`

Added inputs `roles` and `excludeRoles` to filter by user roles.

### Categories

Fetch the children of a category:

- `PostCategory.children: [PostCategory]!`
- `PostCategory.childNames: [String]!`
- `PostCategory.childCount: Int`

```graphql
{
  postCategories(
    pagination: {
      limit: -1
    }
  ) {
    ...CatProps
    children {
      ...CatProps
      children {
        ...CatProps
      }
    }
  }
}

fragment CatProps on PostCategory {
  id
  name
  parent {
    id
    name
  }
}
```

### Menus

Menus have been upgraded, adding the following fields:

- `Root.menus: [Menu]!`: list and filter the menus on the site
- `Root.menuCount: Int!`: count the list of menus
- `Menu.name: String`: menu's name
- `Menu.slug: String`: menu's slug
- `Menu.count: Int`: number of items in the menu
- `Menu.locations: [String]!`: locations assigned to the menu
- `Menu.items: [MenuItem]!`: items for a menu
- `MenuItem.children: [MenuItem]!`: children items for a menu item

```graphql
{
  menus {
    id
    name
    slug
    count
    locations
    items {
      ...MenuItemProps
      children {
        ...MenuItemProps
        children {
          ...MenuItemProps
        }
      }
    }
  }
}

fragment MenuItemProps on MenuItem {
  classes
  description
  id
  objectID
  parentID
  target
  title
  url
}
```

### User avatar

Added type `UserAvatar`, and fields:

- `User.avatar: [UserAvatar]`: the user's avatar
- `UserAvatar.src: String!`: the avatar's URL
- `UserAvatar.size: Int!`: the avatar's size

```graphql
{
  users {
    id
    avatar(size: 150) {
      size
      src
    }
  }
}
```

### Media

Added field arguments to `Root.mediaItems: [Media]!` for filtering results.

Added media fields:

- `Root.imageSizeNames: [String]!` to retrieve the list of the available intermediate image size names
- `Root.mediaItemCount: Int!` to count the number of media items

Added the following fields for media items:

- `Media.srcSet: String`
- `Media.url: String!`
- `Media.localURLPath: String`
- `Media.slug: String!`
- `Media.title: String`
- `Media.caption: String`
- `Media.altText: String`
- `Media.description: String`
- `Media.date: DateTime`
- `Media.dateStr: String`
- `Media.modifiedDate: DateTime`
- `Media.modifiedDateStr: String`
- `Media.mimeType: String`
- `Media.sizes: String`

```graphql
{
  imageSizeNames
  mediaItems(
    pagination: {
      limit: 3
    }
    sort: {
      by: TITLE
      order: DESC
    }
    filter: {
      dateQuery: {
        after: "2012-01-02"
      }
    }
  ) {
    id
    srcSet
    src(size:"medium")
    sizes(size:"medium")
    height
    width
    slug
    url
    urlAbsolutePath
    title
    caption
    altText
    description
    date
    modifiedDate
    mimeType
  }
}
```

### Settings

Field `Root.option` was used to fetch options, from the `wp_options` table. However this was not enough, since it only allowed us to fetch single values, but not arrays or objects, which can [also be handled as options in WordPress](https://developer.wordpress.org/reference/functions/get_option/#return).

This has been fixed now, with the introduction of 2 new fields:

- `Root.optionValues: [AnyBuiltInScalar]`
- `Root.optionObjectValue: JSONObject`

For consistency, field `Root.option` has been renamed:

- `Root.optionValue: AnyBuiltInScalar`

Now, we can execute the following query:

```graphql
{
  # This is a single value
  siteURL: optionValue(name: "siteurl")

  # This is an array
  stickyPosts: optionValues(name: "sticky_posts")

  # This is an object
  themeMods: optionObjectValue(name: "theme_mods_twentytwentyone")
}
```

...which will produce this response:

```json
{
  "data": {
    "siteURL": "https://graphql-api.com",
    "stickyPosts": [
      1241,
      1788,
      1785
    ],
    "themeMods": {
      "custom_css_post_id": -1,
      "nav_menu_locations": {
        "primary": 178,
        "footer": 0
      }
    }
  }
}
```

### Settings configuration

Added additional entries to the default allowlist:

- `"siteurl"`
- `"WPLANG"`
- `"posts_per_page"`
- `"comments_per_page"`
- `"date_format"`
- `"time_format"`
- `"blog_charset"`

## Custom scalars

Support for custom [scalar types](https://graphql.org/learn/schema/#scalar-types) has been added to the GraphQL server! 🎉

Custom scalars allow you to better represent your data, whether for getting an input via a field argument, or printing a customized output in the response.

(The documentation on creating custom scalars will be ready only for v1.0... until then, check the [source code for an example implementation](https://github.com/leoloso/PoP/blob/a882ddf1300ee915b96683fbdf56f09be2ea0447/layers/Schema/packages/schema-commons/src/TypeResolvers/ScalarType/EmailScalarTypeResolver.php)).

### Implementation of standard custom scalar types

Several standard custom scalar types have been implemented, so they are readily-available to be used in your GraphQL schema:

- `Date`
- `DateTime`
- `Email`
- `HTML`
- `URL`
- `URLAbsolutePath`

You can browse their source code [here](https://github.com/leoloso/PoP/tree/c523c8d58fefde40dee5866f29901da5286bd125/layers/Schema/packages/schema-commons/src/TypeResolvers/ScalarType).

### Implementation of `Numeric` scalar

An input in the GraphQL schema may need to receive any numeric value, not caring if it is `Int` or `Float`.

To support these, the new `Numeric` scalar has been introduced. This type acts as a wildcard type, allowing both `Int` or `Float` values, coercing them accordingly.

### Support for the new "Specified By URL" meta property

The custom scalars can expose the [`specifiedBy` property](https://spec.graphql.org/draft/#sec-Scalars.Custom-Scalars) (recently added to the GraphQL spec), providing an URL which defines the behavior of the scalar.

We can query the value via the `specifiedByURL` field, via introspection:

```graphql
{
  __schema {
    emailScalarType: type(name: "Email") {
      specifiedByURL
    }
  }
}
```

## Custom enums

Similar to custom scalars, custom [enum types](https://graphql.org/learn/schema/#enumeration-types) are now supported! 🚀

Enums are a special kind of scalar that is restricted to a particular set of allowed values. This allows you to:

- Validate that any arguments of this type are one of the allowed values
- Communicate through the type system that a field will always be one of a finite set of values

(The documentation on creating custom enums will be ready only for v1.0... until then, check the [source code for an example implementation](https://github.com/leoloso/PoP/blob/c320cb1a4e5db48c5045cb37b66506b4a4a9a695/layers/Schema/packages/comments/src/TypeResolvers/EnumType/CommentStatusEnumTypeResolver.php)).

### Implementation of several enum types

Several enum types have been implemented, and used whenever appropriate in the GraphQL schema, including:

- `CommentOrderByEnum`
- `CommentStatusEnum`
- `CommentTypeEnum`
- `CustomPostEnum`
- `CustomPostOrderByEnum`
- `CustomPostStatusEnum`
- `MediaItemOrderByEnum`
- `MenuOrderByEnum`
- `TaxonomyOrderByEnum`
- `UserOrderByEnum`
- `MenuLocationEnum`

## Input Objects

In addition, the GraphQL server now also supports [input types](https://graphql.org/learn/schema/#input-types), and you can add your own input objects to the GraphQL schema! 💪

Input objects allow you to pass complex objects as inputs to fields, which is particularly useful for mutations.

(The documentation on creating input objects will be ready only for v1.0... until then, check the [source code for an example implementation](https://github.com/leoloso/PoP/blob/accfd9954aa6b26b9d38c39580764b1a38e0f539/layers/Schema/packages/posts/src/TypeResolvers/InputObjectType/RootPostsFilterInputObjectTypeResolver.php)).

### Implementation of several input object types

In all query and mutation fields in the GraphQL schema, data was provided via multiple field arguments. Since `v0.9`, data is instead passed via InputObjects. Whenever appropriate, the following convention is used:

For query fields, organize input objects under:

- `filter`
- `sort`
- `pagination`

For mutation fields, organize input objects under:

- `input`

## Oneof Input Objects

This feature is not in the GraphQL spec yet, but it's expected to be added soon: [graphql/graphql-spec#825](https://github.com/graphql/graphql-spec/pull/825). Since it is extremely valuable, it has already been implemented for the GraphQL API for WordPress.

The "oneof" input object is a particular type of input object, where exactly one of the input fields must be provided as input (or otherwise it returns a validation error). This behavior introduces polymorphism for inputs.

For instance, the field `Root.post` now receives a field argument `by`, which is a oneof input object allowing is to retrieve the post via different properties, such as by `id`:

```graphql
{
  post(
    by: {
      id: 1
    }
  ) {
    id
    title
  }
}
```

...or by `slug`:

```graphql
{
  post(
    by: {
      slug: "hello-world"
    }
  ) {
    id
    title
  }
}
```

The benefit is that a single field can then be used to tackle different use cases, so we can avoid creating a different field for each use case (such as `postByID`, `postBySlug`, etc), thus making the GraphQL schema leaner and more elegant.

### Implementation of several Oneof Input Objects

As mentioned earlier on, all fields to fetch a single entity now receive argument `by`, which is a oneof input filter:

- `Root.customPost(by:)`
- `Root.genericCustomPost(by:)`
- `Root.mediaItem(by:)`
- `Root.menu(by:)`
- `Root.page(by:)`
- `Root.postCategory(by:)`
- `Root.postTag(by:)`
- `Root.post(by:)`
- `Root.user(by:)`

## Link to the online documentation of the GraphQL errors

When executing a GraphQL query and an error is returned, if the error has been documented in the GraphQL spec, then the response will now include a link to its online documentation.

This information is retrieved under the error's `extensions` entry, containing the code of the corresponding validation section in the spec under entry `code`, and its URL under entry `specifiedBy`.

For instance, executing the following query:

```graphql
{
  posts(
    pagination: {limit: $limit}
  ) {
    id
    title
  }
}
```

Will produce this response:

```json
{
  "errors": [
    {
      "message": "Variable 'limit' has not been defined in the operation",
      "locations": [
        {
          "line": 3,
          "column": 25
        }
      ],
      "extensions": {
        "code": "gql@5.8.3",
        "specifiedBy": "https://spec.graphql.org/draft/#sec-All-Variable-Uses-Defined"
      }
    }
  ]
}
```

## Namespacing is applied to new types

The newly introduced types (scalars, enums and input objects), as well as the existing types (object, interfaces and unions) [have their names namespaced](https://graphql-api.com/guides/schema/namespacing-the-schema/).

That means that, if your plugin includes a custom scalar type `Price`, and another plugin does the same, these names will be namespaced (becoming `YourPlugin_Price` and `TheOtherPlugin_Price`), thus avoiding conflicts in the schema.

## Print the full path to the GraphQL query node producing errors

The response now contains the full path to the nodes in the GraphQL query that return an error (under the subentry `extensions.path`), making it easier to find out the source of the problem.

For instance, in the following query, the directive `@nonExisting` does not exist:

```graphql
query {
  myField @nonExisting
}
```

The response is the following:

```json
{
  "errors": [
    {
      "message": "There is no directive with name 'nonExisting'",
      "locations": [
        {
          "line": 2,
          "column": 7
        }
      ],
      "extensions": {
        "type": "QueryRoot",
        "field": "myField @nonExisting",
        "path": [
          "@nonExisting",
          "myField @nonExisting",
          "query { ... }"
        ],
        "code": "PoP\\ComponentModel\\e20"
      }
    }
  ],
  "data": {
    "id": "root"
  }
}
```

## Enable unsafe default settings

The GraphQL API for WordPress provides safe default settings:

- The single endpoint is disabled
- The “sensitive” data elements in the GraphQL schema (such as `User.roles`, or filtering posts by `status`) are not exposed
- Only a handful of the settings options and meta keys (for posts, users, etc) can be queried
- The number of entities that can be queried at once is limited (for posts, users, etc)

These safe default settings are needed to make "live" sites secure, to prevent malicious attacks. However, they are not needed when building "static" sites, where the WordPress site is not vulnerable to attacks (as when it's a development site on a laptop, sitting behind a secure firewall, or not exposed to the Internet in general).

Starting from `v0.9`, we can enable unsafe defaults by adding in `wp-config.php`:

```php
define( 'GRAPHQL_API_ENABLE_UNSAFE_DEFAULTS', true );
```

Alternatively, we can define this same key/value as an environment variable.

When enabling unsafe defaults, the default plugin settings are transformed like this:

- The single endpoint is enabled
- The “sensitive” data elements are exposed in the GraphQL schema
- All settings options and meta keys can be queried
- The number of entities that can be queried at once is unlimited

## Schema Configuration for the Single Endpoint

Starting from `v0.9`, the GraphQL single endpoint can be assigned a Schema Configuration (similar to the custom endpoints).

This means we can now configure the single endpoint:

- Nested mutations
- Schema namespacing
- Expose “sensitive” data

To configure the single endpoint, go to tab "Schema Configuration" on the Settings page, and select the desired Schema Configuration entry from the dropdown for "Schema Configuration for the Single Endpoint", and click on "Save Changes":

![Settings for the Schema Configuration for the Single Endpoint](../../images/settings-schema-configuration-for-single-endpoint.png)

## Display `"causes"` for errors in response (#893)

As has been [requested for the GraphQL spec on #893](https://github.com/graphql/graphql-spec/issues/893), when resolving a field fails due to multiple underlying reasons, it makes sense to show them all together under the subentry `"causes"` in the GraphQL response.

This feature is now supported.

## Sort fields and connections together, alphabetically

When retrieving the GraphQL schema via introspection, all connections were shown first, and only then all fields.

Now, they are sorted all together, making it easier to browse the fields in the GraphiQL Docs Explorer.

## The entities from the WordPress data model are not namespaced anymore

The WordPress data model is considered canonical, then its GraphQL schema types (such as `Post` and `User`) and interfaces (such as `Commentable` and `WithMeta`) do not need be namespaced. If any plugin were to provide the same name for any of these entities, the plugin's namespacing will already differentiate among them.

For instance, type `Post` was namespaced as `PoPSchema_Posts_Post`. From `v0.9`, `Post` will always be `Post`, in both the normal and namespaced schemas.

Namespacing applies to those types added by extensions. In this image, types `Event` and `Location` have been namespaced using the `EM_` prefix:

![Namespaced schema](../../images/namespaced-interactive-schema.png)

## Split Settings into "Default value for Schema Configuration" and "Value for the Admin"

The settings for several modules has been split into 2 separate items:

1. **Default value for Schema Configuration**: value to apply when the corresponding option in the Schema Configuration is set to `"Default"`
2. **Value for the Admin**: value to apply in the wp-admin, including the GraphiQL and Interactive Schema clients.

This decoupling allows us to try out some functionality (such as nested mutations) in the wp-admin's GraphiQL and Interactive Schema clients first, and only later enable it for the exposed endpoints.

The updated modules are:

- Schema Namespacing
- Nested Mutations
- Expose Sensitive Data in the Schema

![Selecting the same field on the two possible root types](../../images/releases/v09/split-settings-into-2.png)

## Validate constraints for field and directive arguments

Resolvers for fields and directives can now validate constraints on the argument values.

For instance, if field `Root.posts` has a maximum limit of 100 items, and we execute the following query:

```graphql
{
  posts(
    pagination: {
      limit: 150
    }
  ) {
    id
  }
}
```

... then we get an error:

```json
{
  "errors": [
    {
      "message": "The value for input field 'limit' in input object 'PostPaginationInput' cannot be above '100', but '150' was provided",
      "extensions": {
        "type": "QueryRoot",
        "field": "posts(pagination:{limit:150})"
      }
    }
  ],
  "data": {
    "posts": null
  }
}
```

## Added options "default limit" and "max limit" for Posts and Pages

The Settings for Posts and Pages used the "default limit" and "max limit" values assigned in the tab for Custom Posts.

Now, they have their own:

![Default and max limit options for posts in the Settings page](../../images/releases/v09/posts-settings-new-options.png)

## Return an error if access is not allowed for the option name or meta key

When executing field `Root.option`, if [access to the option name is not allowed in the Settings](https://graphql-api.com/guides/config/defining-settings-allowed-entries/), the query now returns an error.

For instance, executing this query:

```graphql
{
  optionValue(name:"nonExistentOption")
}
```

Returns:

```json
{
  "errors": [
    {
      "message": "There is no option with name 'nonExistentOption'",
      "extensions": {
        "type": "Root",
        "id": "root",
        "field": "optionValue(name:\"nonExistentOption\")"
      }
    }
  ],
  "data": {
    "option": null
  }
}
```

The same behavior happens for the meta fields, when querying for a meta key whose [access is not allowed in the Settings](https://graphql-api.com/guides/config/querying-by-meta-values/):

- `Post.metaValue`
- `Post.metaValues`
- `Page.metaValue`
- `Page.metaValues`
- `User.metaValue`
- `User.metaValues`
- `Comment.metaValue`
- `Comment.metaValues`
- `PostCategory.metaValue`
- `PostCategory.metaValues`
- `PostTag.metaValue`
- `PostTag.metaValues`

For instance, executing this query:

```graphql
{
  post(by: { id: 1 }) {
    id
    metaValue(key: "nothingHere")
  }
}
```

Returns:

```json
{
  "errors": [
    {
      "message": "There is no meta with key 'nothingHere'",
      "extensions": {
        "type": "Post",
        "field": "metaValue(key:\"nothingHere\")"
      }
    }
  ],
  "data": {
    "post": {
      "id": 1,
      "metaValue": null
    }
  }
}
```

## Completed all remaining query validations defined by the GraphQL spec

The plugin now implements all the validations required by the GraphQL spec.

The following ones where added:

- There are no cyclical fragment references ([spec](https://spec.graphql.org/draft/#sec-Fragment-spreads-must-not-form-cycles))
- There are no duplicate fragment names ([spec](https://spec.graphql.org/draft/#sec-Fragment-Name-Uniqueness))
- Fragment spread type existence ([spec](https://spec.graphql.org/draft/#sec-Fragment-Spread-Type-Existence))
- Fragment spread can be applied on unions, in addition to objects/interfaces ([spec](https://spec.graphql.org/October2021/#sec-Fragments-On-Composite-Types))
- Variables are input types ([spec](https://spec.graphql.org/draft/#sec-Variables-Are-Input-Types))
- Queried fields are unambiguous ([spec](https://spec.graphql.org/draft/#sec-Field-Selection-Merging))

## Query `extensions` in the schema introspection

Custom metadata attached to schema elements can now be queried via field `extensions`. This is a feature [requested for the GraphQL spec](https://github.com/graphql/graphql-spec/issues/300#issuecomment-504734306), but not yet approved. This GraphQL server already implements it, though, since it is very useful.

All introspection elements of the schema have been upgraded with the new field, each of them returning an object of a corresponding "`Extensions`" type, which exposes the custom properties for that element.

```graphql
# Using "_" instead of "__" in introspection type name to avoid errors in graphql-js
type _SchemaExtensions {
  # Is the schema being namespaced?
  isNamespaced: Boolean!
}

extend type __Schema {
  extensions: _SchemaExtensions!
}

type _NamedTypeExtensions {
  # The type name
  elementName: String!

  # The "namespaced" type name
  namespacedName: String!
}

extend type __Type {
  # Non-null for named types, null for wrapping types (Non-Null and List)
  extensions: _NamedTypeExtensions
}

type _DirectiveExtensions {
  # If no objects are returned in the field (eg: because they failed validation), does the directive still need to be executed?
  needsDataToExecute: Boolean!
}

extend type __Directive {
  extensions: _DirectiveExtensions!
}

type _FieldExtensions {
  # Useful for nested mutations
  isMutation: Boolean!

  # `true` => Only exposed when "Expose “sensitive” data elements" is enabled
  isSensitiveDataElement: Boolean!
}

extend type __Field {
  extensions: _FieldExtensions!
}

type _InputValueExtensions {
  isSensitiveDataElement: Boolean!
}

extend type __InputValue {
  extensions: _InputValueExtensions!
}

type _EnumValueExtensions {
  isSensitiveDataElement: Boolean!
}

extend type __EnumValue {
  extensions: _EnumValueExtensions!
}
```

### Implemented extension `isSensitiveDataElement`

Several `extensions` fields expose property `isSensitiveDataElement`, to identify which are the “sensitive” data elements from the schema (i.e. elements which can only be accessed when "Expose Sensitive Data in the Schema" is enabled in the Schema Configuration).

To retrieve this data, execute this query:

```graphql
query ViewSensitiveDataElements {
  __schema {
    types {
      name
      fields {
        name
        extensions {
          isSensitiveDataElement
        }
        args {
          name
          extensions {
            isSensitiveDataElement
          }
        }
      }
      inputFields {
        name
        extensions {
          isSensitiveDataElement
        }
      }
      enumValues {
        name
        extensions {
          isSensitiveDataElement
        }
      }
    }
  }
}
```

And then search for entries with `"isSensitiveDataElement": true` in the results.

## Performance improvement: Avoid regenerating the container when the schema is modified

The explanation below is a bit technical, but the TL;DR is: the plugin is now faster when saving CPTs (such as the Schema Configuration).

When a Schema Configuration is modified, the schema must be regenerated. This was done by purging the whole cache folder, which contains both the service container and the schema configuration files. However, since regenerating the service container takes a few seconds, we'd rather not purge that folder when there is no need to.

From `v0.9`, the service container and the schema both have independent timestamps tracking their state, and they can be purged independently. Hence, modifying the schema will only purge the corresponding cached files, and there will be an improvement in performance when editing any of the CPTs provided in the plugin.

## Clicking on "Save Changes" on the Settings page will always regenerate the schema

If we are testing an extension and the schema is cached, it must be purged. To do so, we can modify some value in the Settings page and save, which would regenerate the schema. But this required some value to be modified.

From `v0.9` it is not needed to modify any value on the Settings. Just clicking on the "Save Changes" button will always regenerate the schema.

## Prettyprint GraphQL queries in the module docs

The GraphQL queries in the module documentation are now prettyprinted:

![Prettyprinted GraphQL queries in module docs](../../images/releases/v09/prettyprinted-code.png)

## Upgraded GraphiQL

The plugin upgraded [GraphiQL](https://github.com/graphql/graphiql/tree/main/packages/graphiql) to version `v1.5.7`

## Finished decoupling the GraphQL server code from WordPress

The underlying GraphQL server powering the plugin can now be installed and executed as a standalone PHP component, i.e. independently of the underlying CMS.

As a consequence, the GraphQL API available to this plugin can also be installed in an application based on a different framework (such as Symfony/Laravel/etc) with minimal effort 🙏🎉👏💪🚀.

To use the GraphQL server as a standalone PHP component, install package `graphql-by-pop/graphql-server` using Composer:

```bash
composer require graphql-by-pop/graphql-server
```

And then initialize the GraphQL server, build the schema, and execute the query, like this:

```php
use GraphQLByPoP\GraphQLServer\Standalone\GraphQLServer;

// List of modules to initialize to build the GraphQL schema
$graphQLServerModuleClasses = [
  // ...
];
$graphQLServer = new GraphQLServer($graphQLServerModuleClasses);
$response = $graphQLServer->execute($query, $variables);
$response->sendHeaders();
echo $response->getContent();
```

## Browse documentation when editing a Schema Configuration, Custom Endpoint and Persisted Query

All the blocks shown when editing a Schema Configuration, Custom Endpoint and Persisted Query now have an "info" button which, when clicked, displays documentation on a modal window.

![Clicking on an "info" button...](../../images/releases/v09/modal-window-with-module-doc-1.png)

![...opens a modal window with documentation](../../images/releases/v09/modal-window-with-module-doc-2.png)

## Fixed issues

- Fixed newlines removed from GraphQL query after refreshing browser ([#972](https://github.com/leoloso/PoP/pull/972))

## Improvements in Development and Testing

The [development code and process](https://github.com/leoloso/PoP) underwent numerous improvements:

- Created several hundred new unit and integration tests
- Upgraded all code to PHPStan's level 8
- Bumped the min PHP version to 8.1 for development (transpiled to PHP 7.1 when generating the plugin)

## Breaking changes

### Replaced argument `id` with `by` in fields fetching a single entity

Fields to fetch a single entity, such as `Root.post` or `Root.user`, used to receive argument `id` to select the entity. Now they have been expanded: `id` has been replaced with argument `by`, which is a oneof input object to query the entity by different properties.

The following fields have been upgraded:

- `Root.customPost`
- `Root.genericCustomPost`
- `Root.mediaItem`
- `Root.menu`
- `Root.page`
- `Root.postCategory`
- `Root.postTag`
- `Root.post`
- `Root.user`

Then, querying an entity by ID must be updated. This GraphQL query:

```graphql
{
  post(id: 1) {
    title
  }
}
```

...must be transformed like this:

```graphql
{
  post(by: {
    id: 1
  }) {
    title
  }
}
```

### Must update GraphQL queries to use the new `filter`, `pagination` and `sort` field arguments

In `v0.9`, field arguments for fetching elements have been organized into input objects, under args `filter`, `pagination` and `sort`. Hence, all GraphQL queries must be updated.

For instance, this query from `v0.8`:

```graphql
{
  posts(
    searchfor: "Hello",
    limit: 3,
    offset: 3,
    order: "title|DESC"
  ) {
    id
    title
  }
}
```

...is now done like this:

```graphql
{
  posts(
    filter:{
      search: "Hello"
    }
    pagination: {
      limit: 3,
      offset: 3
    }
    sort: {
      by: TITLE
      order: DESC
    }
  ) {
    id
    title
  }
}
```

Most input fields have the same name as the field argument they replace, such as:

- `Root.posts(ids:)` => `Root.posts(filter:ids)`

There are a few exceptions, though, such as:

- `Root.posts(searchfor:)` => `Root.posts(filter:search)`
- `Root.users(nombre:)` => `Root.users(filter:searchBy.name)`

Please visualize the Explorer Docs in GraphiQL, and the Interactive Schema, to understand how the GraphQL schema has been upgraded.

### Renamed module "Expose Sensitive Data in the Schema"

Renamed module "Schema for the Admin" to "Expose Sensitive Data in the Schema". If this module had been disabled, it must be disabled again.

In addition, its block for the Schema Configuration also got renamed, so you must click on "Reset the template" on all Schema Configurations to show the block again:

![Click on "Reset the template" on all Schema Configurations](../../images/releases/v09/schema-config-reset-the-template.png)

### Renamed scalar type `AnyScalar` to `AnyBuiltInScalar`

Because custom scalar `AnyScalar` only represents the 5 built-in GraphQL scalar types (`String`, `Int`, `Boolean`, `Float`, and `ID`), it was renamed to `AnyBuiltInScalar` to better convey this information.

### Renamed interface type `Elemental` to `Node`

The `Elemental` interface contains field `id: ID!`. It has been renamed to `Node` to follow the convention by most GraphQL implementations (for instance, by [GitHub's GraphQL API](https://docs.github.com/en/graphql/reference/interfaces#node)).

### Renamed field `Root.option` to `Root.optionValue`

For consistency, since adding fields `optionValues` and `optionObjectValue`.

### Changed type for `date` fields to the new `DateTime`

Date fields in `v0.8` were of type `String`, and had field argument `format`:

- `Post.date(format: String): String!`
- `Media.date(format: String): String!`
- `Comment.date(format: String): String!`
- `Post.modifiedDate(format: String): String!`
- `Media.modifiedDate(format: String): String!`
- `User.registeredDate(format: String): String!`

These fields have been renamed as `...Str`:

- `Post.dateStr(format: String): String!`
- `Media.dateStr(format: String): String!`
- `Comment.dateStr(format: String): String!`
- `Post.modifiedDateStr(format: String): String!`
- `Media.modifiedDateStr(format: String): String!`
- `User.registeredDateStr(format: String): String!`

And in their place, they have been converted to type `DateTime`, and have had the argument `format` removed (since specifing how to print the date value does not apply anymore):

- `Post.date: DateTime!`
- `Media.date: DateTime!`
- `Comment.date: DateTime!`
- `Post.modifiedDate: DateTime!`
- `Media.modifiedDate: DateTime!`
- `User.registeredDate: DateTime!`

### Must update `content(format:PLAIN_TEXT)` to `rawContent`

Since `content` fields are now of type `HTML`, to obtain it as a `String` the query must be updated to using `rawContent` instead.

### Must update the inputs for mutations

Mutation fields now use input objects instead of field arguments, hence they must be updated.

For instance, mutation `createPost` now receives data via an input object under field argument `filter`:

```graphql
mutation {
  createPost(input:{
    title: "Saronga donga",
    content: "cento per cento italiano"
    status: publish,
    tags: ["sette","giorni","su","sette"],
    categoryIDs: [1,58,55],
    featuredImageID: 771
  }) {
    id
    title
    content
    tags {
      id
      name
    }
    categories {
      id
      name
    }
    featuredImage {
      id
      src
    }
  }
}
```

As another example, mutation `loginUser` was used like this:

```graphql
mutation {
  loginUser(
    usernameOrEmail: "admin",
    password: "pachonga"
  ) {
    id
    name
  }
}
```

Now, `loginUser` relies on the oneof input object, and logging-in the user must be done like this:

```graphql
mutation {
  loginUser(
    by: {
      credentials: {
        usernameOrEmail: "admin",
        password: "pachonga"
      },
    }
  ) {
    id
    name
  }
}
```

### Merged the “sensitive” data and non-sensitive-data fields

Removed all the "unrestricted" fields (which were exposed via module `Expose Sensitive Data in the Schema`). Instead, a single field will now tackle all of its data, whether it is “sensitive” data or not.

To do this, fields will show or hide some element (such as a field argument or enum value) depending on the GraphQL schema being exposed as “sensitive” or not. (This is configured in block `Expose Sensitive Data in the Schema` from the Schema Configuration).

For instance, field `Root.posts` has argument `filter`. When the GraphQL schema is configured to expose “sensitive” data, this input object exposes an additional input field `status`, enabling to filter posts by status `"draft"`, `"pending"` or `"trash"` (i.e. allowing to fetch private posts).

The list of “sensitive” (or "unrestricted") fields which were removed, and what fields now handle their, is this one:

Root:

- `unrestrictedPost` => `post`
- `unrestrictedPosts` => `posts`
- `unrestrictedPostCount` => `postCount`
- `unrestrictedCustomPost` => `customPost`
- `unrestrictedCustomPosts` => `customPosts`
- `unrestrictedCustomPostCount` => `customPostCount`
- `unrestrictedPage` => `page`
- `unrestrictedPages` => `pages`
- `unrestrictedPageCount` => `pageCount`

User:

- `unrestrictedPosts` => `posts`
- `unrestrictedPostCount` => `postCount`
- `unrestrictedCustomPosts` => `customPosts`
- `unrestrictedCustomPostCount` => `customPostCount`

PostCategory:

- `unrestrictedPosts` => `posts`
- `unrestrictedPostCount` => `postCount`

PostTag:

- `unrestrictedPosts` => `posts`
- `unrestrictedPostCount` => `postCount`

### `User.email` is treated as “sensitive” field

From now on, field `User.email` is treated as “sensitive” data. As such, it is exposed only if property `Expose Sensitive Data in the Schema` is enabled.

This behavior can be overriden in the Settings page:

![Settings to treat user email as “sensitive” data](../../images/settings-treat-user-email-as-sensitive-data.png)

### Removed modules

Since `v0.9`, the following modules are not included anymore in the GraphQL API for WordPress plugin:

- Access Control
- Cache Control
- Public/Private Schema Mode
- Low-Level Persisted Query Editing

### Settings for several modules must be set again

Those modules which had their Settings value split into 2 ("Default value for Schema Configuration" and "Value for the Admin") must be set again:

- Schema Namespacing
- Nested Mutations
- Expose Sensitive Data in the Schema

In addition, the `Default Schema Configuration` option for module "Schema Configuration" has been renamed, and it must also be set again.

![Must set again the value for Default Schema Configuration](../../images/releases/v09/renamed-option-set-again.png)

### Must re-set options "default limit" and "max limit" for Posts and Pages

Posts and pages do not take their "default limit" and "max limit" values from the Custom Posts anymore. Now we must set their own values, under sections "Schema Posts" and "Schema Pages" in the Settings page.
